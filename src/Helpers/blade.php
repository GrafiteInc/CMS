<?php

if (!function_exists('menu')) {
    function menu($slug, $view = null)
    {
        return app('QuarxService')->menu($slug, $view);
    }
}

if (!function_exists('images')) {
    function images($tag = null)
    {
        return app('QuarxService')->images($tag);
    }
}

if (!function_exists('widget')) {
    function widget($slug)
    {
        return app('QuarxService')->widget($slug);
    }
}

if (!function_exists('editBtn')) {
    function edit($module, $id = null)
    {
        return app('QuarxService')->module($module, $id);
    }
}
