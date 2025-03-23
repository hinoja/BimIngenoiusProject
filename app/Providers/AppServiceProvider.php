<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // If you need SweetAlert2, use this instead of FilamentAsset
        if (!$this->app->environment('production')) {
            // $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    public function boot(): void
    {
        // Add any boot-time registration here
    }
}
