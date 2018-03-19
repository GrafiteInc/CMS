<?php

namespace Grafite\Cms\Providers;

use App;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Grafite\Cms\Services\BlogService;
use Grafite\Cms\Services\CryptoService;
use Grafite\Cms\Services\EventService;
use Grafite\Cms\Services\ModuleService;
use Grafite\Cms\Services\PageService;
use Grafite\Cms\Services\CmsService;

class CmsServiceProvider extends ServiceProvider
{
    /**
     * Register the services.
     */
    public function register()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('Cms', \Grafite\Cms\Facades\CmsServiceFacade::class);
        $loader->alias('PageService', \Grafite\Cms\Facades\PageServiceFacade::class);
        $loader->alias('EventService', \Grafite\Cms\Facades\EventServiceFacade::class);
        $loader->alias('CryptoService', \Grafite\Cms\Facades\CryptoServiceFacade::class);
        $loader->alias('ModuleService', \Grafite\Cms\Facades\ModuleServiceFacade::class);
        $loader->alias('BlogService', \Grafite\Cms\Facades\BlogServiceFacade::class);
        $loader->alias('FileService', \Grafite\Cms\Services\FileService::class);

        $this->app->bind('CmsService', function ($app) {
            return new CmsService();
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
