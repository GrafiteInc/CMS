<?php

namespace Grafite\Cms\Services;

class ModuleService
{
    public function menus()
    {
        $modulePath = base_path(config('cms.module-directory').'/');
        $modules = glob($modulePath.'*');

        $menu = '';

        foreach ($modules as $module) {
            if (is_dir($module)) {
                $module = lcfirst(str_replace($modulePath, '', $module));
                if (file_exists($modulePath.ucfirst($module).'/Views/menu.blade.php')) {
                    $menu .= view($module.'::menu');
                }
            }
        }

        if (is_array(config('cms.modules'))) {
            foreach (config('cms.modules') as $module => $config) {
                if (!is_dir($modulePath.ucfirst($module))) {
                    $menu .= view($module.'::menu');
                }
            }
        }

        return $menu;
    }
}
