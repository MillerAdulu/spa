<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a admin user role */

        Gate::define('isAdmin', function(User $user) {

            return $user->role == 'admin'
                ? Response::allow()
                : Response::deny('You must be an administrator.');
        });
         
        /* define a manager user role */
         
        Gate::define('isManager', function(User $user) {
         
            return $user->role == 'manager'
                ? Response::allow()
                : Response::deny('You must be a manager.');
        });
         
        /* define a user role */
         
        Gate::define('isUser', function( User $user) {
         
            return $user->role == 'user'
                ? Response::allow()
                : Response::deny('You must be a user.');
        });
    }
}
