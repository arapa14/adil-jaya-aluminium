<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Product;

class HomeController
{
    public function index() {
        $data = Product::all();
        $portofolios = Portfolio::limit(4)->get();
        // dd($data);
        return view('frontend.home', compact('data', 'portofolios'));
    }
}
