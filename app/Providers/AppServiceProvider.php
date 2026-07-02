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
    }
}
