<?php

namespace Yab\Cabin\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Yab\Cabin\Services\BlogService;
use Yab\Cabin\Services\CryptoService;
use Yab\Cabin\Services\EventService;
use Yab\Cabin\Services\ModuleService;
use Yab\Cabin\Services\PageService;
use Yab\Cabin\Services\CabinService;

class CabinServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Cabin', \Yab\Cabin\Facades\CabinServiceFacade::class);
        $loader->alias('PageService', \Yab\Cabin\Facades\PageServiceFacade::class);
        $loader->alias('EventService', \Yab\Cabin\Facades\EventServiceFacade::class);
        $loader->alias('CryptoService', \Yab\Cabin\Facades\CryptoServiceFacade::class);
        $loader->alias('ModuleService', \Yab\Cabin\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \Yab\Cabin\Facades\BlogServiceFacade::class);
        $loader->alias('FileService', \Yab\Cabin\Services\FileService::class);

        $this->app->bind('CabinService', function ($app) {
            return new CabinService();
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
