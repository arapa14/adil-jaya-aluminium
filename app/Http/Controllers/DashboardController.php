<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Product;
use App\Models\Testimonial;
use App\Models\User;

class DashboardController
{
    public function index() {
        $countProduct = Product::count();
        $countGallery = Gallery::count();
        $countTestiomonials = Testimonial::count();
        $countUser = User::count();
        return view('admin.dashboard', compact('countProduct', 'countGallery', 'countTestiomonials', 'countUser'));
    }
}
