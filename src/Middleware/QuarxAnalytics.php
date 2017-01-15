<?php

namespace Yab\Quarx\Middleware;

use Closure;
use Yab\Quarx\Services\AnalyticsService;

class QuarxAnalytics
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
        if (!$request->ajax()) {
            app(AnalyticsService::class)->log($request);
        }

        return $next($request);
    }
}
