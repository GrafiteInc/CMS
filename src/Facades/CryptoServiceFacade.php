<?php

namespace Mlantz\Quarx\Facades;

use Illuminate\Support\Facades\Facade;

class CryptoServiceFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'CryptoService'; }
}