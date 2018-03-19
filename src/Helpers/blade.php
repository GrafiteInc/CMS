<?php

if (!function_exists('menu')) {
    function menu($slug, $view = null)
    {
        return app('CmsService')->menu($slug, $view);
    }
}

if (!function_exists('images')) {
    function images($tag = null)
    {
        return app('CmsService')->images($tag);
    }
}

if (!function_exists('widget')) {
    function widget($slug)
    {
        return app('CmsService')->widget($slug);
    }
}

if (!function_exists('editBtn')) {
    function edit($module, $id = null)
    {
        return app('CmsService')->module($module, $id);
    }
}
