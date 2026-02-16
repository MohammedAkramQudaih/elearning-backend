<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


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
        //
         // استخدام Bootstrap 5 لـ Pagination
        Paginator::useBootstrapFive();
        
        // أو Bootstrap 4 إذا كنت تفضل
        // Paginator::useBootstrapFour();
    }
}
