<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\PortfolioImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class PortfolioController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PortfolioCategory::latest()->get();

        $portfolios = Portfolio::with(['category', 'images'])
            ->latest()
            ->paginate(10);

        return view('admin.portfolios.portfolios.index', compact('categories', 'portfolios'));
    }

    public function indexApi()
    {
        $data = Portfolio::with(['category', 'images'])
            ->latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('thumbnail', function ($portfolio) {
                return '
                <img src="' . asset('storage/' . $portfolio->thumbnail) . '"
                    class="rounded"
                    style="width:80px;height:80px;object-fit:cover;">
            ';
            })
            ->addColumn('portfolio', function ($portfolio) {
                return '
                <div class="fw-bold">
                    ' . $portfolio->title . '
                </div>
                <div class="text-secondary small">
                    ' . $portfolio->slug . '
                </div>
            ';
            })
            ->addColumn('category', function ($portfolio) {
                return '
                <span class="badge bg-blue-lt">
                    ' . ($portfolio->category->name ?? '-') . '
                </span>
            ';
            })
            ->addColumn('status_badge', function ($portfolio) {
                if ($portfolio->status) {
                    return '<span class="badge bg-green">Active</span>';
                }

                return '<span class="badge bg-red">Inactive</span>';
            })
            ->addColumn('action', function ($portfolio) {
                $editUrl = route('portfolios.portfolios.edit', $portfolio->id);
                $deleteUrl = route('portfolios.portfolios.destroy', $portfolio->id);
                $modalId = 'modalDeletePortfolio-' . $portfolio->id;

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
                                        Hapus Portofolio
                                    </h5>

                                    <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        Apakah Anda yakin ingin menghapus portfolio
                                        <strong>' . e($portfolio->title) . '</strong>?
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
                'portfolio',
                'category',
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
        $categories = PortfolioCategory::latest()->get();
        return view('admin.portfolios.portfolios.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Array untuk melacak file yang sukses di-upload (Perbaikan untuk blok catch)
        $uploadedFiles = [];
        // 1. Jalankan Validasi
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:portfolio_categories,id',
                'status' => 'required|boolean',

                'slug' => 'nullable|string|max:255',
                'location' => 'required|string',
                'description' => 'required|string',

                'thumbnail' => 'required|image|mimes:jpg,jpeg,png,webp',
                'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

                'meta_title' => 'nullable|string|max:255',
                'meta_description' => 'nullable|string',
                'meta_keywords' => 'nullable|string',
                'focus_keyword' => 'nullable|string|max:255',

                'alt_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

                'images' => 'required|array|min:1',
                'images.*' => 'image|mimes:jpg,jpeg,png,webp',
                // 'alt_texts.*' => 'nullable|string|max:255',
            ]);

            // Bungkus dengan Transaction agar jika galeri/image error, data portofolio ikut di-rollback (tidak tersimpan setengah)
            return DB::transaction(function () use ($request, $validated, &$uploadedFiles) {

                /*
            |--------------------------------------------------------------------------
            | Generate Unique Slug
            |--------------------------------------------------------------------------
            */
                $slugInput = trim((string) ($validated['slug'] ?? ''));
                $nameInput = trim((string) $validated['title']);

                $baseSource = $slugInput !== ''
                    ? $slugInput
                    : ($nameInput !== '' ? $nameInput : 'portfolio');

                $original = Str::slug(mb_strtolower($baseSource));
                $slug = $original;
                $counter = 2;

                while (Portfolio::where('slug', $slug)->exists()) {
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
                    $thumbnailPath = $request->file('thumbnail')->store('portfolios/thumbnails', 'public');
                    $uploadedFiles[] = $thumbnailPath; // Catat file terpilih
                }

                /*
            |--------------------------------------------------------------------------
            | Upload OG Image
            |--------------------------------------------------------------------------
            */
                $ogImagePath = null;
                if ($request->hasFile('og_image')) {
                    $ogImagePath = $request->file('og_image')->store('portfolios/og', 'public');
                    $uploadedFiles[] = $ogImagePath; // Catat file terpilih
                }

                /*
            |--------------------------------------------------------------------------
            | Create Portfolio
            |--------------------------------------------------------------------------
            */
                $portfolio = Portfolio::create([
                    'category_id'      => $validated['category_id'],
                    'title'             => $validated['title'],
                    'slug'             => $slug,
                    'location'         => $validated['location'],
                    'description'      => $validated['description'],
                    'thumbnail'        => $thumbnailPath,
                    'meta_title'       => $validated['meta_title'] ?? $validated['title'],
                    'meta_description' => $validated['meta_description'] ?? $validated['description'],
                    'meta_keywords'    => $validated['meta_keywords'] ?? $validated['title'],
                    'focus_keyword'    => $validated['focus_keyword'] ?? $validated['title'],
                    'og_image'         => $ogImagePath ?? $thumbnailPath,
                    'alt_image'        => $validated['alt_image'] ?? null,
                    'status'           => $validated['status'],
                    'created_by'       => Auth::user()->id,
                ]);
                Log::info("ini oke 3");
                /*
            |--------------------------------------------------------------------------
            | Upload Gallery Images
            |--------------------------------------------------------------------------
            */
                if ($request->hasFile('images')) {
                    $portfolioFolder = Str::slug($validated['title']);
                    foreach ($request->file('images') as $index => $image) {
                        if ($image->isValid()) {
                            $path = $image->store(
                                'portfolios/gallery/' . $portfolioFolder,
                                'public'
                            );

                            $uploadedFiles[] = $path;

                            PortfolioImage::create([
                                'portfolio_id' => $portfolio->id,
                                'image'      => $path,
                                'alt_text'   => $validated['alt_texts'][$index]
                                    ?? $validated['title'] . ' ' . ($index + 1),
                            ]);
                        }
                    }
                }

                flash()->success('Portofolio berhasil dibuat.');
                return back();
            });
        } catch (\Throwable $th) {
            // Hapus file yang terlanjur di-upload ke storage jika DB/proses gagal di tengah jalan
            foreach ($uploadedFiles as $filePath) {
                if (Storage::disk('public')->exists($filePath)) {
                    Storage::disk('public')->delete($filePath);
                }
            }

            // Log pesan error asli agar Anda mudah melakukan debugging jika ada masalah luar
            Log::error('Gagal membuat portofolio: ' . $th->getMessage(), [
                'exception' => $th,
                'user_id'   => Auth::user()->id
            ]);

            flash()->error('Terjadi kesalahan saat membuat portofolio.');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        DB::beginTransaction();

        try {
            /*
        |--------------------------------------------------------------------------
        | Delete Thumbnail
        |--------------------------------------------------------------------------
        */
            if ($portfolio->thumbnail && Storage::disk('public')->exists($portfolio->thumbnail)) {
                Storage::disk('public')->delete($portfolio->thumbnail);
            }

            /*
        |--------------------------------------------------------------------------
        | Delete OG Image
        |--------------------------------------------------------------------------
        */
            if ($portfolio->og_image && Storage::disk('public')->exists($portfolio->og_image)) {
                Storage::disk('public')->delete($portfolio->og_image);
            }

            /*
        |--------------------------------------------------------------------------
        | Delete Gallery Images
        |--------------------------------------------------------------------------
        */
            foreach ($portfolio->images as $image) {

                if ($image->image && Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Delete Gallery Folder
        |--------------------------------------------------------------------------
        */
            $galleryFolder = 'portfolios/gallery/' . $portfolio->slug;

            if (Storage::disk('public')->exists($galleryFolder)) {
                Storage::disk('public')->deleteDirectory($galleryFolder);
            }

            /*
        |--------------------------------------------------------------------------
        | Delete portfolio
        |--------------------------------------------------------------------------
        */
            $portfolio->delete();
            DB::commit();
            flash()->success('Portofolio berhasil dihapus.');
            return back();
        } catch (\Throwable $th) {

            DB::rollBack();
            Log::error('Gagal menghapus portfolio', [
                'message' => $th->getMessage(),
                'portfolio_id' => $portfolio->id,
            ]);
            flash()->error('Terjadi kesalahan saat menghapus portfolio.');
            return back();
        }
    }
}
