<?php

namespace Yab\Quarx;

use Illuminate\Support\Facades\View;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class QuarxProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/PublishedAssets/views'         => base_path('resources/views/quarx'),
            __DIR__.'/PublishedAssets/Controllers'   => app_path('Http/Controllers/Quarx'),
            __DIR__.'/Migrations'                    => base_path('database/migrations'),
            __DIR__.'/PublishedAssets/Middleware'    => app_path('Http/Middleware'),
            __DIR__.'/PublishedAssets/Routes'        => app_path('Http'),
            __DIR__.'/PublishedAssets/Config'        => base_path('config'),
        ]);
    }

    /**
     * Register the services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Yab\Quarx\Providers\QuarxServiceProvider::class);
        $this->app->register(\Yab\Quarx\Providers\QuarxEventServiceProvider::class);
        $this->app->register(\Yab\Quarx\Providers\QuarxRouteProvider::class);
        $this->app->register(\Yab\Quarx\Providers\QuarxModuleProvider::class);
        $this->app->register(\Devfactory\Minify\MinifyServiceProvider::class);
        $this->app->register(\Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('Minify', \Devfactory\Minify\Facades\MinifyFacade::class);
        $loader->alias('LaravelAnalytics', \Spatie\LaravelAnalytics\LaravelAnalyticsFacade::class);

        View::addNamespace('quarx', __DIR__.'/Views');
        View::addNamespace('quarx-frontend', base_path('resources/views/quarx'));

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */

        $this->commands([
            \Yab\Quarx\Console\Publish::class,
            \Yab\Quarx\Console\Module::class,
        ]);
    }
}