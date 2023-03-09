<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('view-company', function(User $user,$company){
            if($user->id == $company[0]->user_id || $user->hasRole('admin')){
                return true;
            }
        });

        Gate::define('update-company', function(User $user,$company){
            if($user->id == $company[0]->user_id || $user->hasRole('admin')){
                return true;
            }
        });

        Gate::define('delete-company', function(User $user,$company){
            if($user->id == $company[0]->user_id || $user->hasRole('admin')){
                return true;
            }
        });

        Gate::define('create-employee', function(User $user){
            if($user->hasRole('company')){
                return true;
            }
        });

        Gate::define('update-employee', function(User $user){
            if($user->hasRole('company')){
                return true;
            }
        });

        Gate::define('delete-employee', function(User $user){
            if($user->hasRole('company')){
                return true;
            }
        });
    }
}
