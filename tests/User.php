<?php

namespace Silvanite\Brandenburg\Test;

use Silvanite\Brandenburg\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as BaseUser;

class User extends BaseUser
{
    use HasRoles;
}
