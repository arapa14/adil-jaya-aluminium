<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\SeoPage;
use App\Models\Service;
use App\Models\Testimonial;

class LandingController
{
    public function home()
    {
        $seo = SeoPage::where('slug', '/')->first();
        $data = Product::where('status', 1)->get();
        $portofolios = Portfolio::limit(6)->where('status', 1)->get();
        // dd($data);
        $testimonials = Testimonial::limit(4)->get();
        return view('frontend.home', compact('data', 'portofolios', 'seo', 'testimonials'));
    }

    public function about()
    {
        $seo = SeoPage::where('slug', 'about')->first();
        return view('frontend.about', compact('seo'));
    }

    public function products()
    {
        $seo = SeoPage::where('slug', 'products')->first();

        $categories = ProductCategory::all();

        $data = Product::with('category')
            ->where('status', 1)
            ->get();

        return view('frontend.products', compact(
            'data',
            'seo',
            'categories'
        ));
    }

    public function portfolio()
    {
        $seo = SeoPage::where('slug', 'portfolio')->first();
        $portofolios = Portfolio::get();
        $categories = PortfolioCategory::all();
        return view('frontend.portfolio', compact('portofolios', 'seo', 'categories'));
    }

    public function portfolioDetail($slug)
    {
        $seo = SeoPage::where('slug', 'portfolio')->first();
        $portofolio = Portfolio::where('slug', $slug)->first();
        $relatedPortfolios = Portfolio::where('category_id', $portofolio->category_id)->where('id', '!=', $portofolio->id)->limit(4)->get();
        return view('frontend.portfolio-detail', compact('portofolio', 'seo', 'relatedPortfolios'));
    }

    public function services()
    {
        $seo = SeoPage::where('slug', 'our-services')->first();
        $services = Service::where('status', 1)->get();
        return view('frontend.services', compact('seo', 'services'));
    }

    public function contact()
    {
        $seo = SeoPage::where('slug', 'contact')->first();
        return view('frontend.contact', compact('seo'));
    }
}
