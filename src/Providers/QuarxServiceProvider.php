<?php

namespace graphite\Quarx\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use graphite\Quarx\Services\BlogService;
use graphite\Quarx\Services\CryptoService;
use graphite\Quarx\Services\EventService;
use graphite\Quarx\Services\ModuleService;
use graphite\Quarx\Services\PageService;
use graphite\Quarx\Services\QuarxService;

class QuarxServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Quarx', \graphite\Quarx\Facades\QuarxServiceFacade::class);
        $loader->alias('PageService', \graphite\Quarx\Facades\PageServiceFacade::class);
        $loader->alias('EventService', \graphite\Quarx\Facades\EventServiceFacade::class);
        $loader->alias('CryptoService', \graphite\Quarx\Facades\CryptoServiceFacade::class);
        $loader->alias('ModuleService', \graphite\Quarx\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \graphite\Quarx\Facades\BlogServiceFacade::class);
        $loader->alias('FileService', \graphite\Quarx\Services\FileService::class);

        $this->app->bind('QuarxService', function ($app) {
            return new QuarxService();
        });

        $this->app->bind('PageService', function ($app) {
            return new PageService();
        });

        $this->app->bind('EventService', function ($app) {
            return App::make(EventService::class);
        });

        $this->app->bind('CryptoService', function ($app) {
            return new CryptoService();
        });

        $this->app->bind('ModuleService', function ($app) {
            return new ModuleService();
        });

        $this->app->bind('BlogService', function ($app) {
            return new BlogService();
        });
    }
}
