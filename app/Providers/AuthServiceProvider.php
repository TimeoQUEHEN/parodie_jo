<?php

namespace App\Providers;

use App\Models\Sport;
use App\Policies\SportPolicy;
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
        // 'App\Model' => 'App\Policies\ModelPolicy',
        Sport::class => SportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('delete-tache', function ($user, $sport) {
            return $user->id === $sport->user_id;
        });

        Gate::define('update-tache', function ($user, $sport) {
            return $user->id === $sport->user_id;
        });
    }
}
