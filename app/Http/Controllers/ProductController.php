<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Setting;
use Illuminate\Http\Request;

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

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:product_categories,id',
            'status' => 'required|boolean',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'focus_keyword' => 'nullable|string',
            'og_image' => 'nullable|string',
            'alt_image' => 'nullable|string',
        ]);

        // Assign attributes individually to avoid mass-assignment issues with the model's $fillable
        $product = new Product();
        $product->category_id = $request->input('category_id');
        $product->name = $request->input('name');
        // buat slug dari input jika ada, kalau tidak pakai nama, kalau nama juga kosong pakai 'product'
        $slugInput = trim((string) $request->input('slug'));
        $name = trim((string) $request->input('name'));
        $baseSource = $slugInput !== '' ? $slugInput : ($name !== '' ? $name : 'product');

        // paksa lowercase dan slugify
        $original = \Illuminate\Support\Str::slug(mb_strtolower($baseSource));
        $slug = $original;

        // pastikan unik: jika sudah ada yang sama, tambahkan -2, -3, dst.
        $counter = 2;
        while (\App\Models\Product::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $counter;
            $counter++;
        }
        $product->slug = $slug;
        $product->description = $request->input('description');
        $product->thumbnail = $request->input('thumbnail');
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->focus_keyword = $request->input('focus_keyword');
        $product->og_image = $request->input('og_image');
        $product->alt_image = $request->input('alt_image');
        $product->status = $request->input('status');
        $product->save();

        return redirect()->back()->with('success', 'Product created successfully.');
    }
}
