<?php

namespace Yab\Quarx\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class QuarxController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $quarxRouteBase;

    public function construct()
    {
        $this->quarxRouteBase = config('quarx.backend-route-prefix', 'quarx');
    }
}
