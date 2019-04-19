<?php

return [
    /**
     * User model class name.
     */
    'userModel' => env('USER_MODEL', 'App\User'),
    
    'user_table_name'   => 'users',
    

    /**
     * Configure Brandenburg to not register its migrations.
     */
    'ignoreMigrations' => false,
];
