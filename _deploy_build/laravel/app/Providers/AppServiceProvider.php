<?php

namespace App\Providers;

use App\Models\Profile;
use App\Models\Setting;
use App\Models\VideoSection;
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
        if (str_starts_with(config('app.url', ''), 'https://')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        View::composer(['layouts.portfolio', 'portfolio.*'], function ($view) {
            $profile = Profile::where('is_active', true)->first() ?? Profile::first();
            $settings = Setting::pluck('value', 'key');
            $videoSection = VideoSection::with('items')->where('is_active', true)->first();

            $view->with([
                'profile' => $profile,
                'settings' => $settings,
                'videoSection' => $videoSection,
            ]);
        });
    }
}
