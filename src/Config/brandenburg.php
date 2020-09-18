<?php

return [
    /**
     * User model class name.
     */
    'userModel' => env('USER_MODEL', file_exists('..\App\Models') ? 'App\Models\User' : 'App\User'),

    /**
     * Configure Brandenburg to not register its migrations.
     */
    'ignoreMigrations' => false,
];
