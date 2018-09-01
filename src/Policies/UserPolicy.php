<?php

namespace Silvanite\Brandenburg\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAny($user)
    {
        return $user->can('manageRoles');
    }

    public function view($user)
    {
        return $user->can('manageRoles');
    }

    public function create($user)
    {
        return $user->can('manageRoles');
    }

    public function update($user)
    {
        return $user->can('manageRoles');
    }

    public function delete($user)
    {
        return $user->can('manageRoles');
    }

    public function restore($user)
    {
        return $user->can('manageRoles');
    }

    public function forceDelete($user)
    {
        return $user->can('manageRoles');
    }

    public function attachRole($user, $source, $taget)
    {
        return $user->can('assignRoles');
    }

    public function detachRole($user, $source, $taget)
    {
        return $user->can('addignRoles');
    }
}
