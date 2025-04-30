<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\FetchWeatherData;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

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
        // Gate::define('admin-access', function (User $user) {
        //     return $user->isAdmin();
        // });
    
        // Gate::define('farmer-access', function (User $user) {
        //     return $user->isFarmer();
        // });

        Blade::if('role', function ($roleName) {
            $user = \App\Models\User::with('roles')->find(Auth::id());
            return $user?->roles?->pluck('name')->contains($roleName);
        });
    }
}
