<?php

namespace Silvanite\Brandenburg\Traits;

use Silvanite\Brandenburg\Role;

trait HasRoles
{
    /**
     * Get all Roles given to this user
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Determine if any of the assigned roles to this user
     * have a specific permission
     *
     * @param string $permission
     * @return boolean
     */
    public function hasRoleWithPermission($permission)
    {
        return $this->roles()->get()->filter(function($role) use ($permission) {
            if ($role->hasPermission($permission)) return true;
        })->count();

        
    }

    /**
     * Assign a role to this user
     *
     * @param $role
     * @return boolean
     */
    public function assignRole($role)
    {
        if (is_string($role))
            return $this->roles()->attach(Role::where('slug', $role)->first());

        return $this->roles()->attach($role);
    }

    public function removeRole($role)
    {
        if (is_string($role))
            return $this->roles()->detach(Role::where('slug', $role)->first());

        return $this->roles()->detach($role);
    }

}