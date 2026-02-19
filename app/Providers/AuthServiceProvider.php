<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Starlink; // if you have a model
use App\Policies\StarlinkPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\User::class => StarlinkPolicy::class,
    ];

    public function boot(): void
    {
        // No registerPolicies() needed anymore
        // You just map them via $policies or call Gate::policy()

        // Super Admin override
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('Super Admin')) {
                return true;
            }
        });

        // Optional: if your policy is not mapped via $policies array
        // Gate::policy(Starlink::class, StarlinkPolicy::class);
    }
}
