<?php

if (!function_exists('menu')) {
    function menu($slug, $view = null)
    {
        return app('CabinService')->menu($slug, $view);
    }
}

if (!function_exists('images')) {
    function images($tag = null)
    {
        return app('CabinService')->images($tag);
    }
}

if (!function_exists('widget')) {
    function widget($slug)
    {
        return app('CabinService')->widget($slug);
    }
}

if (!function_exists('editBtn')) {
    function edit($module, $id = null)
    {
        return app('CabinService')->module($module, $id);
    }
}
