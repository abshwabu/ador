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

            // If file was saved to private storage, mirror it to public storage
            $publicFile = storage_path('app/public/' . $path);
            $privateFile = storage_path('app/private/' . $path);
            if (! file_exists($publicFile) && file_exists($privateFile)) {
                @mkdir(dirname($publicFile), 0755, true);
                @copy($privateFile, $publicFile);
            }

            // If file still does not exist on disk, use fallback if provided
            if (! file_exists($publicFile) && $fallback) {
                return asset($fallback);
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
