<?php

namespace Yab\Quarx\Services;

class ModuleService
{
    public function menus()
    {
        $modulePath = base_path(config('quarx.module-directory').'/');

        $menu = $this->_getMenuViews($modulePath);

        if (!is_array(config('quarx.modules'))) {
            return $menu;
        }

        foreach (config('quarx.modules') as $module => $config) {
            if (!is_dir($modulePath.ucfirst($module))) {
                $menu .= view($module.'::menu');
            }
        }

        return $menu;
    }

    /**
     * @param $modulePath
     * @return array
     */
    private function _getMenuViews($modulePath)
    {
        $menu = '';
        foreach (glob($modulePath.'*') as $module) {
            if (!is_dir($module)) {
                continue;
            }
            $module = lcfirst(str_replace($modulePath, '', $module));
            if (file_exists($modulePath . ucfirst($module) . '/Views/menu.blade.php')) {
                $menu .= view($module . '::menu');
            }
        }
        return $menu;
    }
}
