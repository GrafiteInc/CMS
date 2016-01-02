<?php

namespace Mlantz\Quarx\Facades;

use Illuminate\Support\Facades\Facade;

class ModuleServiceFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'ModuleService'; }
}