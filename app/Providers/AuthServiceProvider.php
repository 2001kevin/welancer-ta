<?php

namespace App\Providers;

use App\Models\Pegawai;
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

        Gate::define('access-freelancer', function (Pegawai $pegawai) {
            return $pegawai->role === 'freelancer';
        });

        Gate::define('isUser', function (User $user) {
            return $user;
        });
    }
}
