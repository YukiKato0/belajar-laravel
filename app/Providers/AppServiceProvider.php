<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        View::composer(['layout._inc.header', 'layout._inc.footer'], function ($view): void {
            $settings = Schema::hasTable('settings') ? Setting::pluck('value', 'key')->all() : [];
            $view->with('settings', $settings);
        });
    }
}
