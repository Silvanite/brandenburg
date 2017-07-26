<?php

namespace Silvanite\Brandenburg;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Silvanite\Brandenburg\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    /**
     * The attributes which should be extended to the model
     *
     * @var array
     */
    protected $appends = [
        'roleids'
    ];

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