<?php

namespace App\Http\Controllers;

use App\Models\Product;

class DashboardController
{
    public function index() {
        $countProduct = Product::count();
        return view('admin.dashboard', compact('countProduct'));
    }
}
