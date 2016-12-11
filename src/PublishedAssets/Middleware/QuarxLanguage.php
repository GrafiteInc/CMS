<?php

namespace App\Http\Middleware;

use Closure;
use Config;

class QuarxLanguage
{
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
        if ($request->session()->has('language')) {
            Config::set('app.locale', $request->session()->get('language'));
        }

        return $next($request);
    }
}
