<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PortfolioCategoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\SettingController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/about', [LandingController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
    Route::resource('seo', SEOController::class);

    Route::group(['prefix' => 'products'], function () {
        // API
        Route::get('/products/api', [ProductController::class, 'indexApi'])->name('products.api');

        Route::resources(['category' => ProductCategoryController::class]);
        Route::resources(['products' => ProductController::class]);
    });

    Route::group(['prefix' => 'portfolios', 'as' => 'portfolios.'], function () {
        Route::resources(['category' => PortfolioCategoryController::class]);
        Route::resources(['portfolios' => PortfolioController::class]);
    });
});
