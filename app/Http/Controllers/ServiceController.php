<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ServiceController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }


    public function indexApi()
    {
        $services = Service::latest();

        return DataTables::of($services)
            ->addIndexColumn()
            ->addColumn('thumbnail', function ($services) {
                return '
                <img src="' . asset('storage/' . $services->thumbnail) . '"
                    class="rounded"
                    style="width:80px;height:80px;object-fit:cover;">
            ';
            })
            ->addColumn('service', function ($services) {
                return '
                <div class="fw-bold">
                    ' . $services->title . '
                </div>
                <div class="text-secondary small">
                    ' . $services->slug . '
                </div>
            ';
            })
            ->addColumn('description', function ($services) {
                return '
                    <span class="badge bg-blue-lt">
                        ' . \Illuminate\Support\Str::limit($services->description ?? '-', 50) . '
                    </span>
                ';
            })
            ->addColumn('status_badge', function ($services) {
                if ($services->status) {
                    return '<span class="badge bg-green">Active</span>';
                }

                return '<span class="badge bg-red">Inactive</span>';
            })
            ->addColumn('action', function ($services) {
                $editUrl = route('services.edit', $services->id);
                $deleteUrl = route('services.destroy', $services->id);
                $modalId = 'modalDeleteServices-' . $services->id;

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
                                        Hapus Service
                                    </h5>

                                    <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        Apakah Anda yakin ingin menghapus service
                                        <strong>' . e($services->title) . '</strong>?
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
                'thumbnail',
                'service',
                'description',
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
        return view('admin.services.create');
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
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255',
                'description' => 'required|string',

                'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp',
                'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'focus_keyword' => 'nullable|string|max:255',

                'status' => 'required|boolean',
            ]);

            return DB::transaction(function () use ($request, $validated, &$uploadedFiles) {

                /*
            |--------------------------------------------------------------------------
            | Generate Unique Slug
            |--------------------------------------------------------------------------
            */
                $slugInput = trim((string) ($validated['slug'] ?? ''));
                $titleInput = trim((string) $validated['title']);

                $baseSource = $slugInput !== ''
                    ? $slugInput
                    : ($titleInput !== '' ? $titleInput : 'service');

                $original = Str::slug(mb_strtolower($baseSource));
                $slug = $original;
                $counter = 2;

                while (Service::where('slug', $slug)->exists()) {
                    $slug = $original . '-' . $counter;
                    $counter++;
                }

                /*
            |--------------------------------------------------------------------------
            | Upload Thumbnail
            |--------------------------------------------------------------------------
            */
                $thumbnailPath = null;

                if ($request->hasFile('thumbnail')) {
                    $thumbnailPath = $request
                        ->file('thumbnail')
                        ->store('services/thumbnails', 'public');

                    $uploadedFiles[] = $thumbnailPath;
                }

                /*
            |--------------------------------------------------------------------------
            | Upload OG Image
            |--------------------------------------------------------------------------
            */
                $ogImagePath = null;

                if ($request->hasFile('og_image')) {
                    $ogImagePath = $request
                        ->file('og_image')
                        ->store('services/og', 'public');

                    $uploadedFiles[] = $ogImagePath;
                }

                /*
            |--------------------------------------------------------------------------
            | Create Service
            |--------------------------------------------------------------------------
            */
                Service::create([
                    'title'            => $validated['title'],
                    'slug'             => $slug,
                    'description'      => $validated['description'],

                    'thumbnail'        => $thumbnailPath,

                    'meta_title'       => $validated['meta_title']
                        ?? $validated['title'],

                    'meta_description' => $validated['meta_description']
                        ?? Str::limit(strip_tags($validated['description']), 160),

                    'meta_keywords'    => $validated['meta_keywords']
                        ?? $validated['title'],

                    'focus_keyword'    => $validated['focus_keyword']
                        ?? $validated['title'],

                    'og_image'         => $ogImagePath ?? $thumbnailPath,

                    'status'           => $validated['status'],

                    'created_by'       => Auth::user()->id,
                ]);

                flash()->success('Service berhasil dibuat.');

                return back();
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
            Log::error('Gagal membuat service: ' . $th->getMessage(), [
                'exception' => $th,
                'user_id' => Auth::user()->id,
            ]);

            flash()->error('Terjadi kesalahan saat membuat service.');

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
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
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
                'title' => 'required|string|max:255',
                'slug' => 'nullable|string|max:255',
                'description' => 'required|string',

                'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
                'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'focus_keyword' => 'nullable|string|max:255',

                'status' => 'required|boolean',
            ]);

            return DB::transaction(function () use (
                $request,
                $validated,
                $service,
                &$uploadedFiles
            ) {

                /*
            |--------------------------------------------------------------------------
            | Generate Unique Slug
            |--------------------------------------------------------------------------
            */
                $slugInput = trim((string) ($validated['slug'] ?? ''));
                $titleInput = trim((string) $validated['title']);

                $baseSource = $slugInput !== ''
                    ? $slugInput
                    : ($titleInput !== '' ? $titleInput : 'service');

                $original = Str::slug(mb_strtolower($baseSource));
                $slug = $original;
                $counter = 2;

                while (
                    Service::where('slug', $slug)
                    ->where('id', '!=', $service->id)
                    ->exists()
                ) {
                    $slug = $original . '-' . $counter;
                    $counter++;
                }

                /*
            |--------------------------------------------------------------------------
            | Upload Thumbnail
            |--------------------------------------------------------------------------
            */
                $thumbnailPath = $service->thumbnail;

                if ($request->hasFile('thumbnail')) {

                    $thumbnailPath = $request
                        ->file('thumbnail')
                        ->store('services/thumbnails', 'public');

                    $uploadedFiles[] = $thumbnailPath;

                    // Hapus thumbnail lama
                    if (
                        $service->thumbnail &&
                        Storage::disk('public')->exists($service->thumbnail)
                    ) {
                        Storage::disk('public')->delete($service->thumbnail);
                    }
                }

                /*
            |--------------------------------------------------------------------------
            | Upload OG Image
            |--------------------------------------------------------------------------
            */
                $ogImagePath = $service->og_image;

                if ($request->hasFile('og_image')) {

                    $ogImagePath = $request
                        ->file('og_image')
                        ->store('services/og', 'public');

                    $uploadedFiles[] = $ogImagePath;

                    // Hapus OG lama
                    if (
                        $service->og_image &&
                        Storage::disk('public')->exists($service->og_image)
                    ) {
                        Storage::disk('public')->delete($service->og_image);
                    }
                }

                /*
            |--------------------------------------------------------------------------
            | Update Service
            |--------------------------------------------------------------------------
            */
                $service->update([
                    'title'            => $validated['title'],
                    'slug'             => $slug,
                    'description'      => $validated['description'],

                    'thumbnail'        => $thumbnailPath,

                    'meta_title'       => $validated['meta_title']
                        ?? $validated['title'],

                    'meta_description' => $validated['meta_description']
                        ?? Str::limit(strip_tags($validated['description']), 160),

                    'meta_keywords'    => $validated['meta_keywords']
                        ?? $validated['title'],

                    'focus_keyword'    => $validated['focus_keyword']
                        ?? $validated['title'],

                    'og_image'         => $ogImagePath ?? $thumbnailPath,

                    'status'           => $validated['status'],
                ]);

                flash()->success('Service berhasil diperbarui.');

                return redirect()->route('services.index');
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
            Log::error('Gagal update service: ' . $th->getMessage(), [
                'exception' => $th,
                'user_id' => Auth::user()->id,
            ]);

            flash()->error('Terjadi kesalahan saat memperbarui service.');

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        DB::beginTransaction();

        try {

            /*
        |--------------------------------------------------------------------------
        | Delete Thumbnail
        |--------------------------------------------------------------------------
        */
            if (
                $service->thumbnail &&
                Storage::disk('public')->exists($service->thumbnail)
            ) {
                Storage::disk('public')->delete($service->thumbnail);
            }

            /*
        |--------------------------------------------------------------------------
        | Delete OG Image
        |--------------------------------------------------------------------------
        */
            if (
                $service->og_image &&
                Storage::disk('public')->exists($service->og_image)
            ) {
                Storage::disk('public')->delete($service->og_image);
            }

            /*
        |--------------------------------------------------------------------------
        | Delete Service
        |--------------------------------------------------------------------------
        */
            $service->delete();

            DB::commit();

            flash()->success('Service berhasil dihapus.');

            return back();
        } catch (\Throwable $th) {

            DB::rollBack();

            Log::error('Gagal menghapus service', [
                'message' => $th->getMessage(),
                'service_id' => $service->id,
            ]);

            flash()->error('Terjadi kesalahan saat menghapus service.');

            return back();
        }
    }
}
