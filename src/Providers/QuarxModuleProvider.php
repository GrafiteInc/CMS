<?php

namespace Yab\Quarx\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Yab\Quarx\Services\FileService;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class QuarxModuleProvider extends ServiceProvider
{
    public function boot()
    {
        // $modules = config("quarx.modules");

        $modulePath = base_path(Config::get('quarx.module-directory').'/');
        $modules = glob($modulePath.'*');

        if (is_array($modules)) {
            while (list(,$module) = each($modules)) {

                $module = str_replace($modulePath, '', $module);

                // Load the Routes
                if (file_exists($modulePath.$module.'/routes.php')) {
                    require $modulePath.$module.'/routes.php';
                }

                if (file_exists($modulePath.$module.'/config.php')) {
                    Config::set('quarx.'.strtolower($module), include($modulePath.$module.'/config.php'));
                }

                // Load the Views
                if (is_dir($modulePath.$module.'/Views')) {
                    View::addNamespace(lcfirst($module), $modulePath.$module.'/Views');
                }
            }
        }
    }

    public function register() {}

}
