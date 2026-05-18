<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Product;
use App\Models\SeoPage;

class LandingController
{
    public function home() {
        $seo = SeoPage::where('slug', '/')->first();
        $data = Product::where('status', 1)->get();
        $portofolios = Portfolio::limit(4)->get();
        // dd($data);
        return view('frontend.home', compact('data', 'portofolios', 'seo'));
    }
}
