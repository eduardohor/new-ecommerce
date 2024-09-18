<?php

namespace App\Providers;

use App\Http\Composers\FavoriteComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class FavoriteProvider extends ServiceProvider
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
        View::composer('front.partials.header', FavoriteComposer::class);

    }
}
