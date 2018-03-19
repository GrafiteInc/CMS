<?php

namespace Grafite\Cms\Facades;

use Illuminate\Support\Facades\Facade;

class CmsServiceFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CmsService';
    }
}
