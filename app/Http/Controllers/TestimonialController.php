<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TestimonialController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.testimonials.index');
    }

    public function indexApi()
    {
        $testimonials = Testimonial::latest();

        return DataTables::of($testimonials)
            ->addIndexColumn()

            ->addColumn('photo', function ($testimonial) {
                return '
                <img src="' . asset('storage/' . $testimonial->photo) . '"
                    class="rounded"
                    style="width:80px;height:80px;object-fit:cover;">
            ';
            })

            ->addColumn('customer', function ($testimonial) {
                return '
                <div class="fw-bold">
                    ' . e($testimonial->customer_name) . '
                </div>

                <div class="text-secondary small">
                    ' . e($testimonial->project_type) . '
                </div>
            ';
            })

            ->addColumn('rating_badge', function ($testimonial) {
                return '
                <span class="badge bg-yellow text-dark">
                    ⭐ ' . $testimonial->rating . '/5
                </span>
            ';
            })

            ->addColumn('message', function ($testimonial) {
                return '
                <span class="badge bg-blue-lt">
                    ' . \Illuminate\Support\Str::limit($testimonial->message ?? '-', 50) . '
                </span>
            ';
            })

            ->addColumn('status_badge', function ($testimonial) {
                if ($testimonial->status) {
                    return '<span class="badge bg-green">Active</span>';
                }

                return '<span class="badge bg-red">Inactive</span>';
            })

            ->addColumn('action', function ($testimonial) {
                $editUrl = route('testimonials.edit', $testimonial->id);
                $deleteUrl = route('testimonials.destroy', $testimonial->id);
                $modalId = 'modalDeleteTestimonial-' . $testimonial->id;

                return '
                <div class="d-flex gap-2 justify-content-center">
                    <a href="' . $editUrl . '" class="btn btn-primary">
                        <i class="ti ti-edit"></i>
                        Edit
                    </a>

                    <button type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#' . $modalId . '">
                        <i class="ti ti-trash"></i>
                        Hapus
                    </button>
                </div>

                <!-- Modal Delete -->
                <div class="modal modal-blur fade"
                    id="' . $modalId . '"
                    tabindex="-1">

                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">
                                    Hapus Testimonial
                                </h5>

                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">
                                </button>
                            </div>

                            <div class="modal-body">
                                <p>
                                    Apakah Anda yakin ingin menghapus testimonial dari
                                    <strong>' . e($testimonial->customer_name) . '</strong>?
                                </p>
                            </div>

                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-secondary"
                                    data-bs-dismiss="modal">
                                    Batal
                                </button>

                                <form action="' . $deleteUrl . '" method="POST">
                                    ' . csrf_field() . '
                                    ' . method_field('DELETE') . '

                                    <button type="submit"
                                        class="btn btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            ';
            })

            ->rawColumns([
                'photo',
                'customer',
                'rating_badge',
                'message',
                'status_badge',
                'action'
            ])

            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Melacak file upload untuk rollback jika gagal
        $uploadedFiles = [];

        try {

            /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'project_type'  => 'required|string|max:255',
                'rating'        => 'required|integer|min:1|max:5',
                'message'       => 'required|string',

                'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp',

                'status'        => 'required|boolean',
            ]);

            return DB::transaction(function () use ($request, $validated, &$uploadedFiles) {

                /*
        |--------------------------------------------------------------------------
        | Upload Photo
        |--------------------------------------------------------------------------
        */
                $photoPath = null;

                if ($request->hasFile('photo')) {

                    $photoPath = $request
                        ->file('photo')
                        ->store('testimonials/photos', 'public');

                    $uploadedFiles[] = $photoPath;
                }

                /*
        |--------------------------------------------------------------------------
        | Create Testimonial
        |--------------------------------------------------------------------------
        */
                Testimonial::create([
                    'customer_name' => $validated['customer_name'],

                    'project_type'  => $validated['project_type'],

                    'rating'        => $validated['rating'],

                    'message'       => $validated['message'],

                    'photo'         => $photoPath ?? 'testimonials/default.jpg',

                    'status'        => $validated['status'],

                    'created_by'    => Auth::user()->id,
                ]);

                flash()->success('Testimonial berhasil dibuat.');

                return redirect()->route('testimonials.index');
            });
        } catch (\Throwable $th) {

            /*
    |--------------------------------------------------------------------------
    | Delete Uploaded Files If Failed
    |--------------------------------------------------------------------------
    */
            foreach ($uploadedFiles as $filePath) {

                if (Storage::disk('public')->exists($filePath)) {

                    Storage::disk('public')->delete($filePath);
                }
            }

            /*
    |--------------------------------------------------------------------------
    | Log Error
    |--------------------------------------------------------------------------
    */
            Log::error('Gagal membuat testimonial: ' . $th->getMessage(), [
                'exception' => $th,
                'user_id'   => Auth::user()->id,
            ]);

            flash()->error('Terjadi kesalahan saat membuat testimonial.');

            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        // Melacak file upload baru untuk rollback jika gagal
        $uploadedFiles = [];

        try {

            /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'project_type'  => 'required|string|max:255',
                'rating'        => 'required|integer|min:1|max:5',
                'message'       => 'required|string',

                'photo'         => 'nullable|image|mimes:jpg,jpeg,png,webp',

                'status'        => 'required|boolean',
            ]);

            return DB::transaction(function () use (
                $request,
                $validated,
                $testimonial,
                &$uploadedFiles
            ) {

                /*
        |--------------------------------------------------------------------------
        | Upload Photo
        |--------------------------------------------------------------------------
        */
                $photoPath = $testimonial->photo;

                if ($request->hasFile('photo')) {

                    $photoPath = $request
                        ->file('photo')
                        ->store('testimonials/photos', 'public');

                    $uploadedFiles[] = $photoPath;

                    /*
            |--------------------------------------------------------------------------
            | Delete Old Photo
            |--------------------------------------------------------------------------
            */
                    if (
                        $testimonial->photo &&
                        $testimonial->photo !== 'testimonials/default.jpg' &&
                        Storage::disk('public')->exists($testimonial->photo)
                    ) {

                        Storage::disk('public')->delete($testimonial->photo);
                    }
                }

                /*
        |--------------------------------------------------------------------------
        | Update Testimonial
        |--------------------------------------------------------------------------
        */
                $testimonial->update([
                    'customer_name' => $validated['customer_name'],

                    'project_type'  => $validated['project_type'],

                    'rating'        => $validated['rating'],

                    'message'       => $validated['message'],

                    'photo'         => $photoPath,

                    'status'        => $validated['status'],
                ]);

                flash()->success('Testimonial berhasil diperbarui.');

                return redirect()->route('testimonials.index');
            });
        } catch (\Throwable $th) {

            /*
    |--------------------------------------------------------------------------
    | Delete Uploaded Files If Failed
    |--------------------------------------------------------------------------
    */
            foreach ($uploadedFiles as $filePath) {

                if (Storage::disk('public')->exists($filePath)) {

                    Storage::disk('public')->delete($filePath);
                }
            }

            /*
    |--------------------------------------------------------------------------
    | Log Error
    |--------------------------------------------------------------------------
    */
            Log::error('Gagal update testimonial: ' . $th->getMessage(), [
                'exception' => $th,
                'user_id'   => Auth::user()->id,
            ]);

            flash()->error('Terjadi kesalahan saat memperbarui testimonial.');

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimonial $testimonial)
    {
        DB::beginTransaction();

        try {

            /*
    |--------------------------------------------------------------------------
    | Delete Photo
    |--------------------------------------------------------------------------
    */
            if (
                $testimonial->photo &&
                $testimonial->photo !== 'testimonials/default.jpg' &&
                Storage::disk('public')->exists($testimonial->photo)
            ) {

                Storage::disk('public')->delete($testimonial->photo);
            }

            /*
    |--------------------------------------------------------------------------
    | Delete Testimonial
    |--------------------------------------------------------------------------
    */
            $testimonial->delete();

            DB::commit();

            flash()->success('Testimonial berhasil dihapus.');

            return back();
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('Gagal menghapus testimonial', [
                'message'        => $th->getMessage(),
                'testimonial_id' => $testimonial->id,
            ]);

            flash()->error('Terjadi kesalahan saat menghapus testimonial.');

            return back();
        }
    }
}
