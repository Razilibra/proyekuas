<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        $this->registerPolicies();
        Gate::define('isAdministrator',function(User $user){
            return $user->level->level == 'Administrator';
        });
        Gate::define('isMahasiswa',function(User $user){
            return $user->level->level == 'Mahasiswa';
        });
        Gate::define('isKaprodi',function(User $user){
            return $user->level->level == 'Kaprodi';
        });
        Gate::define('isDosen',function(User $user){
            return $user->level->level == 'Dosen';
        });
        Gate::define('isSuperAdmin',function(User $user){
            return $user->level->level == 'SuperAdmin';
        });
        Gate::define('isKajur',function(User $user){
            return $user->level->level == 'Kajur';
        });

        //
    }
}
