<?php

namespace App\Providers;

use App\Http\Composers\StoreInfoComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class StoreInfoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', StoreInfoComposer::class);
    }
}
