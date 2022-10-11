<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        Gate::define('manage-users', function (User $user) {
            return $user->role_id == 1;
        });
        Gate::define('manage-foto', function (User $user) {
            return $user->role_id == 2;
        });
        Gate::define('manage-gudang', function (User $user) {
            return $user->role_id == 3;
        });
        Gate::define('manage-admingudang', function (User $user) {
            return $user->role_id == 4;
        });
        Gate::define('manage-online', function (User $user) {
            return $user->role_id == 5;
        });
    }
}
