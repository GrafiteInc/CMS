<?php

namespace Yab\Quarx\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class QuarxModuleProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        if (Config::get('quarx.load-modules', false)) {
            $modulePath = base_path(Config::get('quarx.module-directory').'/');
            $modules = glob($modulePath.'*');

            foreach ($modules as $module) {
                if (is_dir($module)) {
                    $module = lcfirst(str_replace($modulePath, '', $module));
                    $moduleProvider = '\Quarx\Modules\_module_\_module_ModuleProvider';
                    $moduleProvider = str_replace('_module_', ucfirst($module), $moduleProvider);
                    $this->app->register($moduleProvider);
                }
            }
        }
    }
}
