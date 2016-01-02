<?php

namespace Mlantz\Quarx\Providers;

use Illuminate\Foundation\AliasLoader;
use Mlantz\Quarx\Services\PageService;
use Illuminate\Support\ServiceProvider;
use Mlantz\Quarx\Services\CryptoService;
use Mlantz\Quarx\Services\ModuleService;

class QuarxServiceProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot
     *
     * @return void
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias("Quarx", \Mlantz\Quarx\Services\QuarxService::class);
        $loader->alias("PageService", \Mlantz\Quarx\Facades\PageServiceFacade::class);
        $loader->alias("CryptoService", \Mlantz\Quarx\Facades\CryptoServiceFacade::class);
        $loader->alias('ModuleService', \Mlantz\Quarx\Facades\ModuleServiceFacade::class);
        $loader->alias('FileService', \Mlantz\Quarx\Services\FileService::class);
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('PageService', function($app) {
            return new PageService();
        });

        $this->app->bind('CryptoService', function($app) {
            return new CryptoService();
        });

        $this->app->bind('ModuleService', function($app) {
            return new ModuleService();
        });
    }
}