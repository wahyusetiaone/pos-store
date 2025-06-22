<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Purchase;

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
        // Register observers
        \App\Models\Sale::observe(\App\Observers\SaleObserver::class);
    }
}
