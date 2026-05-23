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
                    return '<span class="badge" style="background-color: #e6f4ea; color: #137333; padding: 0.5em 0.75em; border-radius: 4px;">Active</span>';
                }

                return '<span class="badge" style="background-color: #fce8e6; color: #c5221f; padding: 0.5em 0.75em; border-radius: 4px;">Inactive</span>';
            })
            ->addColumn('action', function ($product) {
                $editUrl = route('products.edit', $product->id);
                $deleteUrl = route('products.destroy', $product->id);
                $modalId = 'modalDeleteProduct-' . $product->id;

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
                                        Hapus Product
                                    </h5>

                                    <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <p>
                                        Apakah Anda yakin ingin menghapus product
                                        <strong>' . e($product->name) . '</strong>?
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
        // Array untuk melacak file yang sukses di-upload (Perbaikan untuk blok catch)
        $uploadedFiles = [];
        // 1. Jalankan Validasi
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:product_categories,id',
                'status' => 'required|boolean',

                'slug' => 'nullable|string|max:255',
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
                    $ogImagePath = $request->file('og_image')->store('products/og', 'public');
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
                    'description'      => $validated['description'],
                    'thumbnail'        => $thumbnailPath,
                    'meta_title'       => $validated['meta_title'] ?? $validated['name'],
                    'meta_description' => $validated['meta_description'] ?? $validated['description'],
                    'meta_keywords'    => $validated['meta_keywords'] ?? $validated['name'],
                    'focus_keyword'    => $validated['focus_keyword'] ?? $validated['name'],
                    'og_image'         => $ogImagePath ?? $thumbnailPath,
                    'alt_image'        => $validated['alt_image'] ?? null,
                    'status'           => $validated['status'],
                    'created_by'       => Auth::user()->id,
                ]);
                log::info("ini oke 3");
                /*
            |--------------------------------------------------------------------------
            | Upload Gallery Images
            |--------------------------------------------------------------------------
            */
                if ($request->hasFile('images')) {
                    $productFolder = Str::slug($validated['name']);
                    foreach ($request->file('images') as $index => $image) {
                        if ($image->isValid()) {
                            $path = $image->store(
                                'products/gallery/' . $productFolder,
                                'public'
                            );

                            $uploadedFiles[] = $path;

                            ProductImage::create([
                                'product_id' => $product->id,
                                'image'      => $path,
                                'alt_text'   => $validated['alt_texts'][$index]
                                    ?? $validated['name'] . ' ' . ($index + 1),
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

            flash()->error('Terjadi kesalahan saat membuat produk.');
            return back()->withInput();
        }
    }


    public function edit(Product $product)
    {
        $categories = ProductCategory::latest()->get();
        $product->load('images');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        /*
    |--------------------------------------------------------------------------
    | Validation
    |--------------------------------------------------------------------------
    */
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:product_categories,id',
            'description' => 'required|string',
            'status' => 'required|boolean',
            /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        */
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'focus_keyword' => 'nullable|string|max:255',

            /*
        |--------------------------------------------------------------------------
        | Images
        |--------------------------------------------------------------------------
        */
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'alt_image' => 'nullable|image|mimes:jpg,jpeg,png,webp',

            /*
        |--------------------------------------------------------------------------
        | Gallery
        |--------------------------------------------------------------------------
        */
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:product_images,id',
        ]);

        DB::beginTransaction();

        try {
            /*
        |--------------------------------------------------------------------------
        | Thumbnail Update
        |--------------------------------------------------------------------------
        */
            $thumbnailPath = $product->thumbnail;
            if ($request->hasFile('thumbnail')) {
                // delete old thumbnail
                if (
                    $product->thumbnail &&
                    Storage::disk('public')->exists($product->thumbnail)
                ) {
                    Storage::disk('public')->delete($product->thumbnail);
                }

                // upload new thumbnail
                $thumbnailPath = $request->file('thumbnail')
                    ->store('products/thumbnails', 'public');
            }

            /*
        |--------------------------------------------------------------------------
        | OG Image Update
        |--------------------------------------------------------------------------
        */
            $ogImagePath = $product->og_image;
            if ($request->hasFile('og_image')) {
                // delete old og image
                if (
                    $product->og_image &&
                    Storage::disk('public')->exists($product->og_image)
                ) {
                    Storage::disk('public')->delete($product->og_image);
                }

                // upload new image
                $ogImagePath = $request->file('og_image')
                    ->store('products/og', 'public');
            }

            /*
        |--------------------------------------------------------------------------
        | Slug (Permanent)
        |--------------------------------------------------------------------------
        |
        | Best practice:
        | slug tidak berubah otomatis ketika nama berubah.
        |
        */
            $slug = $product->slug;

            /*
        |--------------------------------------------------------------------------
        | Update Product
        |--------------------------------------------------------------------------
        */
            $product->update([
                'category_id' => $validated['category_id'],
                'name' => $validated['name'],
                'slug' => $slug,
                'description' => $validated['description'],
                'thumbnail' => $thumbnailPath,
                'meta_title' => $validated['meta_title']
                    ?? $validated['name'],
                'meta_description' => $validated['meta_description']
                    ?? $validated['description'],
                'meta_keywords' => $validated['meta_keywords']
                    ?? $validated['name'],
                'focus_keyword' => $validated['focus_keyword']
                    ?? $validated['name'],
                'og_image' => $ogImagePath,
                'alt_image' => $validated['alt_image']
                    ?? $validated['name'],
                'status' => $validated['status'],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Delete Selected Gallery Images
            |--------------------------------------------------------------------------
            */
            if ($request->filled('delete_images')) {

                $imagesToDelete = ProductImage::whereIn(
                    'id',
                    $request->delete_images
                )
                    ->where('product_id', $product->id)
                    ->get();

                foreach ($imagesToDelete as $image) {

                    // hapus file storage
                    if (
                        $image->image &&
                        Storage::disk('public')->exists($image->image)
                    ) {
                        Storage::disk('public')->delete($image->image);
                    }

                    // hapus row database
                    $image->delete();
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Upload New Gallery Images
        |--------------------------------------------------------------------------
        */
            if ($request->hasFile('images')) {
                $galleryFolder = 'products/gallery/' . $product->slug;

                foreach ($request->file('images') as $index => $image) {
                    if ($image->isValid()) {
                        $path = $image->store(
                            $galleryFolder,
                            'public'
                        );

                        ProductImage::create([
                            'product_id' => $product->id,

                            'image' => $path,

                            'alt_text' => $validated['name']
                                . ' gallery image '
                                . ($index + 1),
                        ]);
                    }
                }
            }

            DB::commit();

            flash()->success('Product berhasil diperbarui.');

            return redirect()
                ->route('products.index');
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error('Gagal update product', [
                'message' => $th->getMessage(),
                'product_id' => $product->id,
            ]);

            flash()->error('Terjadi kesalahan saat update product.');

            return back()->withInput();
        }
    }

    public function destroy(Product $product)
    {
        DB::beginTransaction();

        try {

            /*
        |--------------------------------------------------------------------------
        | Delete Thumbnail
        |--------------------------------------------------------------------------
        */
            if ($product->thumbnail && Storage::disk('public')->exists($product->thumbnail)) {
                Storage::disk('public')->delete($product->thumbnail);
            }

            /*
        |--------------------------------------------------------------------------
        | Delete OG Image
        |--------------------------------------------------------------------------
        */
            if ($product->og_image && Storage::disk('public')->exists($product->og_image)) {
                Storage::disk('public')->delete($product->og_image);
            }

            /*
        |--------------------------------------------------------------------------
        | Delete Gallery Images
        |--------------------------------------------------------------------------
        */
            foreach ($product->images as $image) {

                if ($image->image && Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
            }

            /*
        |--------------------------------------------------------------------------
        | Delete Gallery Folder
        |--------------------------------------------------------------------------
        */
            $galleryFolder = 'products/gallery/' . $product->slug;

            if (Storage::disk('public')->exists($galleryFolder)) {
                Storage::disk('public')->deleteDirectory($galleryFolder);
            }

            /*
        |--------------------------------------------------------------------------
        | Delete Product
        |--------------------------------------------------------------------------
        */
            $product->delete();
            DB::commit();
            flash()->success('Product berhasil dihapus.');
            return back();
        } catch (\Throwable $th) {

            DB::rollBack();
            Log::error('Gagal menghapus product', [
                'message' => $th->getMessage(),
                'product_id' => $product->id,
            ]);
            flash()->error('Terjadi kesalahan saat menghapus product.');
            return back();
        }
    }

    public function filterProduct(Request $request)
    {
        $query = Product::with('category')
            ->where('status', 1);

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->get();

        return response()->json($products);
    }
}
