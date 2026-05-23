<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PortfolioCategoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/about', [LandingController::class, 'about'])->name('about');
Route::get('/products', [LandingController::class, 'products'])->name('products');
Route::get('/portfolio', [LandingController::class, 'portfolio'])->name('portfolio');
Route::get('/portfolio/{slug}', [LandingController::class, 'portfolioDetail'])->name('portfolio.show');
Route::get('/our-services', [LandingController::class, 'services'])->name('services.landing');
Route::get('/contact', [LandingController::class, 'contact'])->name('contact');
Route::get('/gallery', [LandingController::class, 'gallery'])->name('gallery');

Route::get('/api/products', [ProductController::class, 'filterProduct'])->name('products.filter');
Route::get('/api/portfolios', [PortfolioController::class, 'filterPortfolio'])->name('portfolios.filter');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    // API
    Route::get('/services/api', [ServiceController::class, 'indexApi'])->name('services.api');
    Route::get('/testimonials/api', [TestimonialController::class, 'indexApi'])->name('testimonials.api');
    Route::get('/galleries/api', [GalleryController::class, 'indexApi'])->name('galleries.api');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('seo', SEOController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('galleries', GalleryController::class);

    Route::group(['prefix' => 'products'], function () {
        // API
        Route::get('/products/api', [ProductController::class, 'indexApi'])->name('products.api');

        Route::resources(['category' => ProductCategoryController::class]);
        Route::resources(['products' => ProductController::class]);
    });

    Route::group(['prefix' => 'portfolios', 'as' => 'portfolios.'], function () {
        // API
        Route::get('/portfolios/api', [PortfolioController::class, 'indexApi'])->name('portfolios.api');

        Route::resources(['category' => PortfolioCategoryController::class]);
        Route::resources(['portfolios' => PortfolioController::class]);
    });
});
