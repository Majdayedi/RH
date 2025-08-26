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
        // Share language data with all views
        view()->composer('*', function ($view) {
            $view->with([
                'currentLocale' => app()->getLocale(),
                'isRtl' => in_array(app()->getLocale(), ['ar']),
                'availableLanguages' => [
                    'en' => ['name' => 'English', 'flag' => '🇺🇸'],
                    'fr' => ['name' => 'Français', 'flag' => '🇫🇷'],
                    'ar' => ['name' => 'العربية', 'flag' => '🇸🇦'],
                ]
            ]);
        });
    }
}
