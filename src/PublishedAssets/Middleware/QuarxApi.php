<?php

namespace App\Http\Middleware;

use Closure;
use Gate;

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
        if (Gate::allows('quarx-api')) {
            return $next($request);
        }

        return response('Unauthorized.', 401);
    }
}
