<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;

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
        View::composer('*', function ($view) {
            try {
                $settings = Setting::getAll();
                $cafeName = $settings['cafe_name'] ?? 'Kantin Sekolah';
                $appName = $settings['app_name'] ?? $cafeName;
            } catch (\Exception $e) {
                // Jika database belum siap atau tabel settings belum ada
                $cafeName = 'Kantin Sekolah';
                $appName = $cafeName;
            }

            $view->with('cafeName', $cafeName);
            $view->with('appName', $appName);
        });
    }
}
