<?php

namespace Silvanite\Brandenburg;

use Illuminate\Support\Facades\Gate;

class Policy
{
    /**
     * Retrieves all registered policies from the Gate
     *
     * @return array
     */
    public static function all()
    {
        return array_keys(Gate::abilities());
    }
}