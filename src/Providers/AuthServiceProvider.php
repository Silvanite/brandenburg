<?php

namespace Silvanite\Brandenburg\Providers;

use Silvanite\Brandenburg\Role;
use Illuminate\Support\Facades\Gate;
use Silvanite\Brandenburg\Policies\RolePolicy;
use Silvanite\Brandenburg\Policies\UserPolicy;
use Silvanite\Brandenburg\Traits\ValidatesPermissions;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;

    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->policies[config('brandenburg.userModel')] = UserPolicy::class;
        clock($this->policies);
        $this->registerPolicies();
        $this->defineGates();
    }

    private function defineGates()
    {
        collect([
            'manageRoles',
            'assignRoles',
        ])->each(function ($permission) {
            Gate::define($permission, function ($user) use ($permission) {
                if ($this->nobodyHasAccess($permission)) {
                    return true;
                }

                return $user->hasRoleWithPermission($permission);
            });
        });
    }
}
