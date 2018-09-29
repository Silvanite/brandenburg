<?php

namespace Silvanite\Brandenburg\Traits;

use Illuminate\Support\Facades\Cache;
use Silvanite\Brandenburg\Permission;

trait ValidatesPermissions
{
    /**
     * If nobody has this permission, grant access to everyone
     * This avoids you from being locked out of your application
     *
     * @param string $permission
     * @return boolean
     */
    protected function nobodyHasAccess($permission)
    {
        return Cache::rememberForever("brandenburg.nobodyhasaccess.{$permission}", function () use ($permission) {
            if (!$requestedPermission = Permission::find($permission)) return true;

            return !$requestedPermission->hasUsers();
        });
    }
}
