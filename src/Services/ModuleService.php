<?php

namespace Yab\Quarx\Services;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class ModuleService
{
    public function menus()
    {
        $modulePath = base_path(Config::get('quarx.module-directory').'/');
        $modules = glob($modulePath.'*');

        $menu = '';

        foreach ($modules as $module) {
            if (is_dir($module)) {
                $module = lcfirst(str_replace($modulePath, '', $module));
                if (file_exists($modulePath.ucfirst($module).'/Views/menu.blade.php')) {
                    $menu .= View::make($module.'::menu');
                }
            }
        }

        return $menu;
    }
}
