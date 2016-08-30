<?php

namespace Yab\Quarx;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Quarx;

class QuarxProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/PublishedAssets/Views/themes'         => base_path('resources/themes'),
            __DIR__.'/PublishedAssets/Controllers'          => app_path('Http/Controllers/Quarx'),
            __DIR__.'/Migrations'                           => base_path('database/migrations'),
            __DIR__.'/PublishedAssets/Middleware'           => app_path('Http/Middleware'),
            __DIR__.'/PublishedAssets/Routes'               => app_path('Http'),
            __DIR__.'/PublishedAssets/Config'               => base_path('config'),
        ]);

        $theme = Config::get('quarx.frontend-theme', 'default');

        $this->loadViewsFrom(__DIR__.'/Views', 'quarx');
        View::addLocation(base_path('resources/themes/'.$theme));
        View::addNamespace('quarx-frontend', base_path('resources/themes/'.$theme));

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        Blade::directive('theme', function ($expression) {
            if (Str::startsWith($expression, '(')) {
                $expression = substr($expression, 1, -1);
            }

            $theme = Config::get('quarx.frontend-theme');
            $view = '"quarx-frontend::'.str_replace('"', '', str_replace("'", '', $expression)).'"';

            return "<?php echo \$__env->make($view, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });

        Blade::directive('menu', function ($expression) {
            return "<?php echo Quarx::menu$expression; ?>";
        });

        Blade::directive('widget', function ($expression) {
            return "<?php echo Quarx::widget$expression; ?>";
        });

        Blade::directive('images', function ($expression) {
            return "<?php echo Quarx::images$expression; ?>";
        });

        Blade::directive('edit', function ($expression) {
            return "<?php echo Quarx::editBtn$expression; ?>";
        });

        Blade::directive('markdown', function ($expression) {
            return "<?php echo Markdown::convertToHtml($expression); ?>";
        });
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

        $this->app->register(\Yab\Laracogs\LaracogsProvider::class);
        $this->app->register(\Devfactory\Minify\MinifyServiceProvider::class);
        $this->app->register(\Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('Minify', \Devfactory\Minify\Facades\MinifyFacade::class);
        $loader->alias('LaravelAnalytics', \Spatie\LaravelAnalytics\LaravelAnalyticsFacade::class);
        $loader->alias('Markdown', \GrahamCampbell\Markdown\MarkdownServiceProvider::class);

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */

        $this->commands([
            \Yab\Quarx\Console\ThemeGenerate::class,
            \Yab\Quarx\Console\ThemePublish::class,
            \Yab\Quarx\Console\ModulePublish::class,
            \Yab\Quarx\Console\ModuleMake::class,
            \Yab\Quarx\Console\ModuleCrud::class,
            \Yab\Quarx\Console\Setup::class,
        ]);
    }
}
