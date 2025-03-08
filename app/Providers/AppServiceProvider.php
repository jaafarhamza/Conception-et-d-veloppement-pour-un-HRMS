<?php

namespace App\Providers;

// use Illuminate\Support\ServiceProvider;
use App\Models\Employee;
use App\Policies\EmployeePolicy;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        // For debugging purposes, you can log all gate checks
        Gate::before(function ($user, $ability) {
            Log::info('Gate check', [
                'user' => $user->id,
                'ability' => $ability
            ]);
            return null;
        });
    }
}