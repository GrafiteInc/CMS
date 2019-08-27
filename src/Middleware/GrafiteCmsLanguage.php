<?php

namespace Grafite\Cms\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class GrafiteCmsLanguage
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
        if (Cookie::has('language')) {
            $language = Cookie::get('language');

            if (strlen($language) > 2) {
                $language = Crypt::decrypt($language, false);
            }

            Config::set('app.locale', $language);
        }

        return $next($request);
    }
}
