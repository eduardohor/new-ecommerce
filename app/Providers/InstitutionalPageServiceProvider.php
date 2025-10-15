<?php

namespace App\Providers;

use App\Http\Composers\InstitutionalPageComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class InstitutionalPageServiceProvider extends ServiceProvider
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
        View::composer([
            'front.partials.footer',
            'front.layouts.auth',
            'front.layouts.store',
            'auth.*',
        ], InstitutionalPageComposer::class);
    }
}
