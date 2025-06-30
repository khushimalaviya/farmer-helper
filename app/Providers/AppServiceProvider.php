<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(RateLimiter $rateLimiter): void
    {
        // Define a rate limiter for API routes
        $rateLimiter->for('api', function (Request $request) {
            return Limit::perMinute(60); // Adjust this limit as needed
        });
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
