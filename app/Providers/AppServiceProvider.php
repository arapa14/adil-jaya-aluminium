<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            View::share([
                'favicon' => Setting::value('favicon'),
                'logo' => Setting::value('logo'),
                'hero_image' => Setting::value('hero_image'),
                'whatsapp' => Setting::value('whatsapp'),
                'address' => Setting::value('address'),
                'email' => Setting::value('email'),
            ]);
        }
    }
}
