<?php

namespace Yab\Cabin\Facades;

use Illuminate\Support\Facades\Facade;

class CabinServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CabinService';
    }
}
