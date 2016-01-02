<?php

namespace Mlantz\Quarx;

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
        $this->app->register(\Mlantz\Quarx\Providers\QuarxServiceProvider::class);
        $this->app->register(\Mlantz\Quarx\Providers\QuarxRouteProvider::class);
        $this->app->register(\Mlantz\Quarx\Providers\QuarxModuleProvider::class);
        $this->app->register(\Devfactory\Minify\MinifyServiceProvider::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('Minify', \Devfactory\Minify\Facades\MinifyFacade::class);

        View::addNamespace('quarx', __DIR__.'/Views');
        View::addNamespace('quarx-frontend', base_path('resources/views/quarx'));

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */

        $this->commands([
            \Mlantz\Quarx\Console\Publish::class,
            \Mlantz\Quarx\Console\Module::class,
            \Mlantz\Quarx\Console\Migrate::class,
        ]);
    }
}