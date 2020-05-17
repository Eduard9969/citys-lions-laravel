<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * Extending Blade
         */
        Blade::directive('nl2br_text', function ($expression) {
            return "<?= nl2br({$expression}); ?>";
        });

        /**
         * Production setting
         */
        if (config('app.env') == 'production')
            URL::forceScheme('https');
    }
}
