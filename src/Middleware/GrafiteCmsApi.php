<?php

namespace Grafite\Cms\Middleware;

use Closure;

class GrafiteCmsApi
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
        if (config('cms.api-token') == $request->get('token')) {
            return $next($request);
        }

        return response('Unauthorized.', 401);
    }
}
