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
    view()->composer('*', function ($view) {

        $settings = \Illuminate\Support\Facades\DB::table('settings')
            ->pluck('value', 'key');

        $view->with('siteSettings', $settings);

    });
}
}
