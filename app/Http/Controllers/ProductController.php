<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController
{
    public function index()
    {
        $categories = ProductCategory::latest()->get();

        $products = Product::with(['category', 'images'])
            ->latest()
            ->paginate(10);

        return view('admin.products.index', compact('categories', 'products'));
    }

    public function indexApi()
    {
        $data = Product::with(['category', 'images'])
            ->latest();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('thumbnail', function ($product) {
                return '
                <img src="' . asset('storage/' . $product->thumbnail) . '"
                    class="rounded"
                    style="width:80px;height:80px;object-fit:cover;">
            ';
            })
            ->addColumn('product', function ($product) {
                return '
                <div class="fw-bold">
                    ' . $product->name . '
                </div>
                <div class="text-secondary small">
                    ' . $product->slug . '
                </div>
            ';
            })
            ->addColumn('category', function ($product) {
                return '
                <span class="badge bg-blue-lt">
                    ' . ($product->category->name ?? '-') . '
                </span>
            ';
            })
            ->addColumn('status_badge', function ($product) {
                if ($product->status) {
                    return '<span class="badge bg-green">Active</span>';
                }

                return '<span class="badge bg-red">Inactive</span>';
            })
            ->addColumn('action', function ($product) {
                $editUrl = route('products.edit', $product->id);
                $deleteUrl = route('products.destroy', $product->id);

                return '
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="' . $editUrl . '" class="btn btn-primary">
                            <i class="ti ti-edit"></i>
                            Edit
                        </a>
                        <form action="' . $deleteUrl . '" method="POST"
                            onsubmit="return confirm(\'Yakin ingin menghapus product ini?\')">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash"></i>
                                Hapus
                            </button>
                        </form>
                    </div>
                ';
            })
            ->rawColumns([
                'thumbnail',
                'product',
                'category',
                'status_badge',
                'action'
            ])
            ->make(true);
    }

    public function create()
    {
        $categories = ProductCategory::latest()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Jalankan Validasi
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:product_categories,id',
            'status' => 'required|boolean',

            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',

            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'focus_keyword' => 'nullable|string|max:255',

            'alt_image' => 'nullable|string|max:255',

            'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'alt_texts.*' => 'nullable|string|max:255',
        ]);

        // Array untuk melacak file yang sukses di-upload (Perbaikan untuk blok catch)
        $uploadedFiles = [];

        try {
            // Bungkus dengan Transaction agar jika galeri/image error, data Produk ikut di-rollback (tidak tersimpan setengah)
            return DB::transaction(function () use ($request, $validated, &$uploadedFiles) {

                /*
            |--------------------------------------------------------------------------
            | Generate Unique Slug
            |--------------------------------------------------------------------------
            */
                $slugInput = trim((string) ($validated['slug'] ?? ''));
                $nameInput = trim((string) $validated['name']);

                $baseSource = $slugInput !== ''
                    ? $slugInput
                    : ($nameInput !== '' ? $nameInput : 'product');

                $original = Str::slug(mb_strtolower($baseSource));
                $slug = $original;
                $counter = 2;

                while (Product::where('slug', $slug)->exists()) {
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
                    $thumbnailPath = $request->file('thumbnail')->store('products/thumbnails', 'public');
                    $uploadedFiles[] = $thumbnailPath; // Catat file terpilih
                }

                /*
            |--------------------------------------------------------------------------
            | Upload OG Image
            |--------------------------------------------------------------------------
            */
                $ogImagePath = null;
                if ($request->hasFile('og_image')) {
                    $ogImagePath = $request->file('og_image')->store('products/og-images', 'public');
                    $uploadedFiles[] = $ogImagePath; // Catat file terpilih
                }

                /*
            |--------------------------------------------------------------------------
            | Create Product
            |--------------------------------------------------------------------------
            */
                $product = Product::create([
                    'category_id'      => $validated['category_id'],
                    'name'             => $validated['name'],
                    'slug'             => $slug,
                    'description'      => $validated['description'] ?? null,
                    'thumbnail'        => $thumbnailPath,
                    'meta_title'       => $validated['meta_title'] ?? null,
                    'meta_description' => $validated['meta_description'] ?? null,
                    'meta_keywords'    => $validated['meta_keywords'] ?? null,
                    'focus_keyword'    => $validated['focus_keyword'] ?? null,
                    'og_image'         => $ogImagePath,
                    'alt_image'        => $validated['alt_image'] ?? null,
                    'status'           => $validated['status'],
                    'created_by'       => Auth::user()->id,
                ]);

                /*
            |--------------------------------------------------------------------------
            | Upload Gallery Images
            |--------------------------------------------------------------------------
            */
                if ($request->hasFile('images')) {
                    foreach ($request->file('images') as $index => $image) {
                        if ($image->isValid()) {
                            $path = $image->store('products/gallery', 'public');
                            $uploadedFiles[] = $path; // Catat file terpilih

                            ProductImage::create([
                                'product_id' => $product->id,
                                'image'      => $path,
                                'alt_text'   => $validated['alt_texts'][$index] ?? $validated['name'] . ' ' . $index,
                            ]);
                        }
                    }
                }

                flash()->success('Product berhasil dibuat.');
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
            Log::error('Gagal membuat produk: ' . $th->getMessage(), [
                'exception' => $th,
                'user_id'   => Auth::user()->id
            ]);

            flash()->error('Terjadi kesalahan saat memperbarui pengaturan.');
            return back()->withInput();
        }
    }
}
