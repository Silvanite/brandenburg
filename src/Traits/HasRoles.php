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

    protected function getArrayableAppends()
    {
        $this->appends = array_unique(array_merge(
            $this->appends, [
                'roleids'
            ]
        ));

        return parent::getArrayableAppends();
    }

    /**
     * Get the fillable attributes for the model.
     *
     * @return array
     */
    public function getFillable()
    {
        $this->fillable = array_unique(array_merge(
            $this->fillable, [
                'api_token'
            ]
        ));

        return parent::getFillable();
    }

    /**
     * Get the hidden attributes for the model.
     *
     * @return array
     */
    public function getHidden()
    {
        $this->hidden = array_unique(array_merge(
            $this->hidden, [
                'api_token'
            ]
        ));

        return parent::getHidden();
    }

    /**
     * Generate an array of Role IDs for this model
     *
     * @return array
     */
    public function getRoleidsAttribute()
    {
        return $this->roles()->pluck('id');
    }

}