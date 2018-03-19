<?php

namespace Grafite\Cms\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class GrafiteCmsController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $routeBase;

    protected $repository;

    public function construct()
    {
        $this->routeBase = config('cms.backend-route-prefix', 'cms');
    }
}
