<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
        // Corriger la longueur des clés pour MySQL avec UTF8MB4
        Schema::defaultStringLength(191);

        // Utiliser Bootstrap 5 pour la pagination (car Bootstrap 5.3.0 est utilisé dans le layout)
        Paginator::defaultView('pagination::bootstrap-5');
        Paginator::defaultSimpleView('pagination::simple-bootstrap-5');
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
