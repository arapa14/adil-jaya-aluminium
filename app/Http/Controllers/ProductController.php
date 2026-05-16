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
}
