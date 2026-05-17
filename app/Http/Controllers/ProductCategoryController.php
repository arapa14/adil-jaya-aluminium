<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Throwable;

class ProductCategoryController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::paginate(10);
        return view('admin.products.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug'
        ]);

        try {
            if (empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
                $original = $data['slug'];
                $i = 1;
                while (ProductCategory::where('slug', $data['slug'])->exists()) {
                    $data['slug'] = $original . '-' . $i++;
                }
            }

            ProductCategory::create($data);

            flash()->success('Kategori produk berhasil dibuat.');
            return redirect()->back();
        } catch (Throwable $e) {
            Log::error('Product Category store error: '.$e->getMessage());
            flash()->error('Terjadi kesalahan saat menyimpan kategori.');
            return redirect()->back()->withInput();
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
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:product_categories,slug,' . $id
        ]);

        try {
            $category = ProductCategory::findOrFail($id);
            $category->update($data);

            flash()->success('Kategori produk berhasil diperbarui.');
            return redirect()->back();
        } catch (Throwable $e) {
            Log::error('Product Category update error: '.$e->getMessage());
            flash()->error('Terjadi kesalahan saat memperbarui kategori.');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $category = ProductCategory::findOrFail($id);
            $category->delete();

            flash()->success('Kategori produk berhasil dihapus.');
            return redirect()->back();
        } catch (Throwable $e) {
            Log::error('Product Category destroy error: '.$e->getMessage());
            flash()->error('Terjadi kesalahan saat menghapus kategori.');
            return redirect()->back();
        }
    }
}
