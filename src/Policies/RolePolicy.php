<?php

namespace Silvanite\Brandenburg\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
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
}
