<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     * 
     * @var array<class-string, class-string>
     */

    protected $policies = [
        'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / athorization services.
     * 
     *@return void
     */
    public function boot()
    {
        Gate::before(function($user, $ability) {
            if ($user->hasRole("Super Admin")) {
                return true;
            }
        });
        $this->registerPolicies();

    }
}
