<?php

namespace Grafite\Quarx\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Grafite\Quarx\Services\BlogService;
use Grafite\Quarx\Services\CryptoService;
use Grafite\Quarx\Services\EventService;
use Grafite\Quarx\Services\ModuleService;
use Grafite\Quarx\Services\PageService;
use Grafite\Quarx\Services\QuarxService;

class QuarxServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Quarx', \Grafite\Quarx\Facades\QuarxServiceFacade::class);
        $loader->alias('PageService', \Grafite\Quarx\Facades\PageServiceFacade::class);
        $loader->alias('EventService', \Grafite\Quarx\Facades\EventServiceFacade::class);
        $loader->alias('CryptoService', \Grafite\Quarx\Facades\CryptoServiceFacade::class);
        $loader->alias('ModuleService', \Grafite\Quarx\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \Grafite\Quarx\Facades\BlogServiceFacade::class);
        $loader->alias('FileService', \Grafite\Quarx\Services\FileService::class);

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
