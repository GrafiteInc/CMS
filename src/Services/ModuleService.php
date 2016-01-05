<?php

namespace Mlantz\Quarx\Services;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Mlantz\Quarx\Services\CryptoService;
use Mlantz\Quarx\Repositories\MenuRepository;
use Mlantz\Quarx\Repositories\LinksRepository;
use Mlantz\Quarx\Repositories\PagesRepository;
use Mlantz\Quarx\Repositories\WidgetsRepository;
use Mlantz\Quarx\Interfaces\QuarxServiceInterface;

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

    public function packageMenus()
    {

        Config::get('quarx.packages');

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