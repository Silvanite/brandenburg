<?php

namespace Silvanite\Brandenburg\Traits;

use Silvanite\Brandenburg\Role;

trait HasRoles
{
    /**
     * Get all Roles given to this user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->with('getPermissions')->withTimestamps();
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
        return $this->roles->contains(function ($role) use ($permission) {
            return $role->getPermissions->contains('permission_slug', $permission);
        });
    }

    /**
     * Assign a role to this user
     *
     * @param string|Role $role
     * @return boolean
     */
    public function assignRole($role)
    {
        if (is_string($role)) {
            return $this->roles()->attach(Role::where('slug', $role)->first());
        }

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
        if (is_string($role)) {
            return $this->roles()->detach(Role::where('slug', $role)->first());
        }

        return $this->roles()->detach($role);
    }

    /**
     * Reassign roles from an id or an array of role Ids
     *
     * @param int|array $roles
     * @return void
     */
    public function setRolesById($roles)
    {
        $roles = is_array($roles)? $roles : [$roles];
        return $this->roles()->sync($roles);
    }
}
