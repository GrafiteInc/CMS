<?php

namespace app\Http\Middleware;

use Closure;
use Config;

class QuarxApi
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
        if (Config::get('quarx.apiToken') == $request->get('token')) {
            return $next($request);
        }

        return response('Unauthorized.', 401);
    }
}
