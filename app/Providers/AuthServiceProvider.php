<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('tambah-user', function ($user) {
            return $user->roles()->where('id', 1)->exists();
        });

        Gate::define('ubah-user', function ($user, $targetUser) {
            return $user->roles()->where('id', 1)->exists();
        });
        
        Gate::define('hapus-user', function ($user, $targetUser) {
            return $user->roles()->where('id', 1)->exists();
        });
        
        Gate::define('tambah-permission', function ($user) {
            return $user->roles()->where('id', 1)->exists();
        });

        Gate::define('ubah-permission', function ($user) {
            return $user->roles()->where('id', 1)->exists();
        });

        Gate::define('hapus-permission', function ($user) {
            return $user->roles()->where('id', 1)->exists();
        });

        Gate::define('tambah-role', function ($user) {
            return $user->roles()->where('id', 1)->exists();
        });

        Gate::define('ubah-role', function ($user) {
            return $user->roles()->where('id', 1)->exists();
        });

        Gate::define('hapus-role', function ($user) {
            return $user->roles()->where('id', 1)->exists();
        });
    }
}
