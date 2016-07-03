<?php

if (!function_exists('menu')) {
    function menu($slug, $view = null)
    {
        return app('Quarx')->menu($slug, $view);
    }
}

if (!function_exists('images')) {
    function images($tag = null)
    {
        return app('Quarx')->images($tag);
    }
}

if (!function_exists('widget')) {
    function widget($slug)
    {
        return app('Quarx')->widget($slug);
    }
}

if (!function_exists('editBtn')) {
    function edit($module, $id = null)
    {
        return app('Quarx')->module($module, $id);
    }
}
