<?php

namespace Silvanite\Brandenburg\Facades;

use Illuminate\Support\Facades\Facade;

class PolicyFacade extends Facade {

    /**
     * Get the binding in the IoC container
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'BrandenburgPolicy';
    }
}