<?php

namespace Yab\Cabin\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class CabinModuleProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        if (Config::get('cabin.load-modules', false)) {
            $modulePath = base_path(Config::get('cabin.module-directory').'/');
            $modules = glob($modulePath.'*');

            foreach ($modules as $module) {
                if (is_dir($module)) {
                    $module = lcfirst(str_replace($modulePath, '', $module));
                    $moduleProvider = '\Cabin\Modules\_module_\_module_ModuleProvider';
                    $moduleProvider = str_replace('_module_', ucfirst($module), $moduleProvider);
                    $this->app->register($moduleProvider);
                }
            }
        }
    }
}
