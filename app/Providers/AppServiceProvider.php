<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // Share settings with all views safely
        if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
            $settings = \App\Models\Setting::first() ?? new \App\Models\Setting();
        } else {
            $settings = new \App\Models\Setting();
        }
        view()->share('settings', $settings);

        // Share products and services safely with all views
        if (\Illuminate\Support\Facades\Schema::hasTable('products')) {
            $headerProducts = \App\Models\Product::orderBy('created_at', 'asc')->get();
            view()->share('headerProducts', $headerProducts);
        } else {
            view()->share('headerProducts', collect());
        }

        if (\Illuminate\Support\Facades\Schema::hasTable('services')) {
            $headerServices = \App\Models\Service::orderBy('created_at', 'asc')->get();
            view()->share('headerServices', $headerServices);
        } else {
            view()->share('headerServices', collect());
        }
    }
}
