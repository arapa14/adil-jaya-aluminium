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

    public function about() {
        $seo = SeoPage::where('slug', 'about')->first();
        return view('frontend.about', compact('seo'));
    }

    public function products() {
        $seo = SeoPage::where('slug', '/products')->first();
        $data = Product::where('status', 1)->get();
        return view('frontend.products', compact('data', 'seo'));
    }

    public function portfolio() {
        $seo = SeoPage::where('slug', '/portfolio')->first();
        $portofolios = Portfolio::get();
        return view('frontend.portfolio', compact('portofolios', 'seo'));
    }

    public function services() {
        $seo = SeoPage::where('slug', '/services')->first();
        return view('frontend.services', compact('seo'));
    }

    public function contact() {
        $seo = SeoPage::where('slug', '/contact')->first();
        return view('frontend.contact', compact('seo'));
    }
}
