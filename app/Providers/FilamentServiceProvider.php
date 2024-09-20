<?php

namespace App\Providers;

use Filament\Filament;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Optional: Register services
    }

    public function boot(): void
    {
        Filament::serving(function () {
            if (auth()->check() && auth()->user()->role === 'buyer') {
                abort(403, 'Access denied');
            }
        });
    }
}
