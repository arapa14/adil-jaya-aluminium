<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class GalleryController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.galleries.index');
    }

    public function indexApi()
    {
        $galleries = Gallery::latest();

        return DataTables::of($galleries)

            ->addIndexColumn()

            ->addColumn('image_preview', function ($gallery) {
                return '
                <img src="' . asset('storage/' . $gallery->image) . '"
                    class="rounded"
                    style="width:80px;height:80px;object-fit:cover;">
            ';
            })
            ->addColumn('gallery_info', function ($gallery) {
                return '
                <div class="fw-bold">
                    ' . e($gallery->caption) . '
                </div>
                <div class="text-secondary small">
                    ' . e($gallery->alt_text) . '
                </div>
            ';
            })
            ->addColumn('status_badge', function ($gallery) {
                if ($gallery->status) {
                    return '<span class="badge bg-green">Active</span>';
                }
                return '<span class="badge bg-red">Inactive</span>';
            })
            ->addColumn('action', function ($gallery) {
                $editUrl = route('galleries.edit', $gallery->id);
                $deleteUrl = route('galleries.destroy', $gallery->id);
                $modalId = 'modalDeleteGallery-' . $gallery->id;

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
                                    Hapus Gallery
                                </h5>
                                <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="modal"
                                    aria-label="Close">
                                </button>
                            </div>

                            <div class="modal-body">
                                <p>
                                    Apakah Anda yakin ingin menghapus gallery
                                    <strong>' . e($gallery->caption) . '</strong>?
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
                'image_preview',
                'gallery_info',
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
        return view('admin.galleries.create');
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
                'caption'   => 'required|string|max:255',

                'alt_text'  => 'nullable|string|max:255',

                'image'     => 'required|image|mimes:jpg,jpeg,png,webp',

                'status'    => 'required|boolean',
            ]);

            return DB::transaction(function () use (
                $request,
                $validated,
                &$uploadedFiles
            ) {

                /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */
                $imagePath = null;

                if ($request->hasFile('image')) {

                    $imagePath = $request
                        ->file('image')
                        ->store('galleries', 'public');

                    $uploadedFiles[] = $imagePath;
                }

                /*
        |--------------------------------------------------------------------------
        | Create Gallery
        |--------------------------------------------------------------------------
        */
                Gallery::create([
                    'image' => $imagePath,

                    'caption' => $validated['caption'],

                    'alt_text' => $validated['alt_text']
                        ?? $validated['caption'],

                    'status' => $validated['status'],

                    'created_by' => Auth::user()->id,
                ]);

                flash()->success('Gallery berhasil dibuat.');

                return redirect()->route('galleries.index');
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
            Log::error('Gagal membuat gallery: ' . $th->getMessage(), [
                'exception' => $th,
                'user_id' => Auth::user()->id,
            ]);

            flash()->error('Terjadi kesalahan saat membuat gallery.');

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
    public function edit(Gallery $gallery)
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
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
                'caption'   => 'required|string|max:255',

                'alt_text'  => 'nullable|string|max:255',

                'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp',

                'status'    => 'required|boolean',
            ]);

            return DB::transaction(function () use (
                $request,
                $validated,
                $gallery,
                &$uploadedFiles
            ) {

                /*
        |--------------------------------------------------------------------------
        | Upload Image
        |--------------------------------------------------------------------------
        */
                $imagePath = $gallery->image;

                if ($request->hasFile('image')) {

                    $imagePath = $request
                        ->file('image')
                        ->store('galleries', 'public');

                    $uploadedFiles[] = $imagePath;

                    /*
            |--------------------------------------------------------------------------
            | Delete Old Image
            |--------------------------------------------------------------------------
            */
                    if (
                        $gallery->image &&
                        Storage::disk('public')->exists($gallery->image)
                    ) {

                        Storage::disk('public')->delete($gallery->image);
                    }
                }

                /*
        |--------------------------------------------------------------------------
        | Update Gallery
        |--------------------------------------------------------------------------
        */
                $gallery->update([
                    'image' => $imagePath,

                    'caption' => $validated['caption'],

                    'alt_text' => $validated['alt_text']
                        ?? $validated['caption'],

                    'status' => $validated['status'],
                ]);

                flash()->success('Gallery berhasil diperbarui.');

                return redirect()->route('galleries.index');
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
            Log::error('Gagal update gallery: ' . $th->getMessage(), [
                'exception' => $th,
                'gallery_id' => $gallery->id,
                'user_id' => Auth::user()->id,
            ]);

            flash()->error('Terjadi kesalahan saat memperbarui gallery.');

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        DB::beginTransaction();

        try {

            /*
    |--------------------------------------------------------------------------
    | Delete Image
    |--------------------------------------------------------------------------
    */
            if (
                $gallery->image &&
                Storage::disk('public')->exists($gallery->image)
            ) {

                Storage::disk('public')->delete($gallery->image);
            }

            /*
    |--------------------------------------------------------------------------
    | Delete Gallery
    |--------------------------------------------------------------------------
    */
            $gallery->delete();

            DB::commit();

            flash()->success('Gallery berhasil dihapus.');

            return back();
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('Gagal menghapus gallery', [
                'message' => $th->getMessage(),
                'gallery_id' => $gallery->id,
                'user_id' => Auth::user()->id,
            ]);

            flash()->error('Terjadi kesalahan saat menghapus gallery.');

            return back();
        }
    }
}
