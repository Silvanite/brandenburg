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
     * Scope a query to eager load `roles` relationship
     * to reduce database queries
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithRoles($query)
    {
        return $query->with('roles');
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
     * @param string|Role $role
     * @return boolean
     */
    public function assignRole($role)
    {
        if (is_string($role))
            return $this->roles()->attach(Role::where('slug', $role)->first());

        return $this->roles()->attach($role);
    }

    /**
     * Remove a role from this user
     *
     * @param string|Role $role
     * @return boolean
     */
    public function removeRole($role)
    {
        if (is_string($role))
            return $this->roles()->detach(Role::where('slug', $role)->first());

        return $this->roles()->detach($role);
    }

    /**
     * Reassign roles from an array of role Ids
     *
     * @param array $roles
     * @return void
     */
    public function setRolesById(array $roles)
    {
        return $this->roles()->sync($roles);
    }
}