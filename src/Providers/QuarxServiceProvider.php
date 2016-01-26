<?php

namespace Yab\Quarx\Providers;

use Illuminate\Foundation\AliasLoader;
use Yab\Quarx\Services\PageService;
use Illuminate\Support\ServiceProvider;
use Yab\Quarx\Services\CryptoService;
use Yab\Quarx\Services\ModuleService;
use Yab\Quarx\Services\QuarxService;

class QuarxServiceProvider extends ServiceProvider
{

     /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'eloquent.saving: Yab\Quarx\Models\Blog' => [
            'Yab\Quarx\Models\Blog@beforeSaved',
        ],

        'eloquent.saved: Yab\Quarx\Models\Blog' => [
            'Yab\Quarx\Models\Blog@afterSaved',
        ],
    ];

    /**
     * Alias the services in the boot
     *
     * @return void
     */
    public function boot()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias("Quarx", \Yab\Quarx\Facades\QuarxServiceFacade::class);
        $loader->alias("PageService", \Yab\Quarx\Facades\PageServiceFacade::class);
        $loader->alias("CryptoService", \Yab\Quarx\Facades\CryptoServiceFacade::class);
        $loader->alias('ModuleService', \Yab\Quarx\Facades\ModuleServiceFacade::class);
        $loader->alias('FileService', \Yab\Quarx\Services\FileService::class);
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('QuarxService', function($app) {
            return new QuarxService();
        });

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