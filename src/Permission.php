<?php

namespace Silvanite\Brandenburg;

use Silvanite\Brandenburg\Role;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    /**
     * Sets the primary key for this model
     *
     * @var string
     */
    protected $primaryKey = 'permission_slug';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'permission_slug'
    ];

    /**
     * Sets the table name for this model
     *
     * @var string
     */
    protected $table = 'role_permission';

    /**
     * Find all roles which have this permission granted
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Determine if any users have access to this permission
     *
     * @return boolean
     */
    public function hasUsers()
    {
        return (bool)$this->roles()->has('users')->count();
    }

    /**
     * Forget the cached state of the nobodyHasAccess method for a given permission
     *
     * @param string $permission
     * @return void
     */
    public static function invalidateNobodyHasAccessCache($permission)
    {
        Cache::forget("brandenburg.nobodyhasaccess.{$permission}");
    }
}
