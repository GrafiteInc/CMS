<?php

namespace Yab\Quarx\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class QuarxModuleProvider extends ServiceProvider
{
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        $modulePath = base_path(Config::get('quarx.module-directory').'/');
        $modules = glob($modulePath.'*');

        if (is_array($modules)) {
            while (list(, $module) = each($modules)) {
                $module = str_replace($modulePath, '', $module);

                // Load the Routes
                if (file_exists($modulePath.$module.'/routes.php')) {
                    require $modulePath.$module.'/routes.php';
                }

                // Load configs
                if (file_exists($modulePath.$module.'/config.php')) {
                    Config::set('quarx.modules.'.strtolower($module), include($modulePath.$module.'/config.php'));
                }

                // Load events
                $events->listen('eloquent.saved: Quarx\Modules\\'.str_plural($module).'\\Models\\'.str_singular($module), 'Quarx\Modules\\'.str_plural($module).'\\Models\\'.str_singular($module).'@afterSaved');

                // Load the Views
                if (is_dir($modulePath.$module.'/Views')) {
                    View::addNamespace(lcfirst($module), $modulePath.$module.'/Views');
                }
            }
        }
    }

    public function register()
    {
    }
}
