<?php

namespace App\Providers;

use App\Models\Setting;
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
        View::share('resolveImage', function (?string $path, string $fallback = '') {
            if (! $path) {
                return $fallback ? asset($fallback) : '';
            }

            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://') || str_starts_with($path, 'data:')) {
                return $path;
            }

            if (str_starts_with($path, 'images/')) {
                return asset($path);
            }

            return asset('storage/' . $path);
        });

        View::composer('*', function ($view) {
            if (! $view->offsetExists('settings')) {
                $view->with('settings', Setting::instance());
            }
        });
    }
}
