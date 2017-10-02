<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cookie;

class QuarxLanguage
{
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->cookie('language')) {
            $this->app->setLocale($request->cookie('language'));
        }

        return $next($request);
    }
}
