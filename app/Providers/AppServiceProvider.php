<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
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
        // Set default paginator view to use our custom design
        Paginator::defaultView('vendor.pagination.default');
        Paginator::defaultSimpleView('vendor.pagination.simple-default');

        View::composer('*', function ($view) {
            try {
                $settings = Setting::getAll();
                $cafeName = $settings['cafe_name'] ?? 'Cafe Management System';
                $appName = $settings['app_name'] ?? $cafeName;
            } catch (\Exception $e) {
                // Jika database belum siap atau tabel settings belum ada
                $cafeName = 'Cafe Management System';
                $appName = $cafeName;
            }

            $view->with('cafeName', $cafeName);
            $view->with('appName', $appName);
        });
    }
}
