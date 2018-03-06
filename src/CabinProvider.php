<?php

namespace Yab\Cabin;

use Devfactory\Minify\Facades\MinifyFacade;
use Devfactory\Minify\MinifyServiceProvider;
use GrahamCampbell\Markdown\Facades\Markdown;
use GrahamCampbell\Markdown\MarkdownServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageServiceProvider;
use Cabin;
use Spatie\LaravelAnalytics\LaravelAnalyticsFacade;
use Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider;
use Yab\Laracogs\LaracogsProvider;
use Yab\Cabin\Console\Keys;
use Yab\Cabin\Console\ModuleComposer;
use Yab\Cabin\Console\ModuleCrud;
use Yab\Cabin\Console\ModuleMake;
use Yab\Cabin\Console\ModulePublish;
use Yab\Cabin\Console\Setup;
use Yab\Cabin\Console\ThemeGenerate;
use Yab\Cabin\Console\ThemePublish;
use Yab\Cabin\Providers\CabinEventServiceProvider;
use Yab\Cabin\Providers\CabinModuleProvider;
use Yab\Cabin\Providers\CabinRouteProvider;
use Yab\Cabin\Providers\CabinServiceProvider;

class CabinProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/PublishedAssets/Views/themes' => base_path('resources/themes'),
            __DIR__.'/PublishedAssets/Controllers' => app_path('Http/Controllers/Cabin'),
            __DIR__.'/PublishedAssets/Migrations' => base_path('database/migrations'),
            __DIR__.'/PublishedAssets/Middleware' => app_path('Http/Middleware'),
            __DIR__.'/PublishedAssets/Routes' => base_path('routes'),
            __DIR__.'/PublishedAssets/Config' => base_path('config'),
        ]);

        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/vendor/cabin'),
        ], 'backend');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $theme = Config::get('cabin.frontend-theme', 'default');

        $this->loadViewsFrom(__DIR__.'/Views', 'cabin');

        View::addLocation(base_path('resources/themes/'.$theme));
        View::addNamespace('cabin-frontend', base_path('resources/themes/'.$theme));

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        Blade::directive('theme', function ($expression) {
            if (Str::startsWith($expression, '(')) {
                $expression = substr($expression, 1, -1);
            }

            $theme = Config::get('cabin.frontend-theme');
            $view = '"cabin-frontend::'.str_replace('"', '', str_replace("'", '', $expression)).'"';

            return "<?php echo \$__env->make($view, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });

        Blade::directive('menu', function ($expression) {
            return "<?php echo Cabin::menu($expression); ?>";
        });

        Blade::directive('block', function ($expression) {
            return "<?php echo \$page->block($expression); ?>";
        });

        Blade::directive('languages', function ($expression) {
            if (count(config('cabin.languages')) > 1) {
                $languageLinks = [];
                foreach (config('cabin.languages') as $key => $value) {
                    $languageLinks[] = '<a class="language-link" href="'.url(config('cabin.backend-route-prefix', 'cabin').'/language/set/'.$key).'">'.$value.'</a>';
                }

                $languageLinkString = implode($languageLinks);

                return "<?php echo '$languageLinkString'; ?>";
            }

            return '';
        });

        Blade::directive('modules', function ($expression) {
            return "<?php echo Cabin::moduleLinks($expression); ?>";
        });

        Blade::directive('widget', function ($expression) {
            return "<?php echo Cabin::widget($expression); ?>";
        });

        Blade::directive('image', function ($expression) {
            return "<?php echo Cabin::image($expression); ?>";
        });

        Blade::directive('image_link', function ($expression) {
            return "<?php echo Cabin::imageLink($expression); ?>";
        });

        Blade::directive('images', function ($expression) {
            return "<?php echo Cabin::images($expression); ?>";
        });

        Blade::directive('edit', function ($expression) {
            return "<?php echo Cabin::editBtn($expression); ?>";
        });

        Blade::directive('editBtn', function ($expression) {
            return "<?php echo Cabin::editBtnSecondary($expression); ?>";
        });

        Blade::directive('markdown', function ($expression) {
            return "<?php echo Markdown::convertToHtml($expression); ?>";
        });
    }

    /**
     * Register the services.
     */
    public function register()
    {
        $this->app->register(CabinServiceProvider::class);
        $this->app->register(CabinEventServiceProvider::class);
        $this->app->register(CabinRouteProvider::class);
        $this->app->register(CabinModuleProvider::class);

        $this->app->register(LaracogsProvider::class);
        $this->app->register(MinifyServiceProvider::class);
        $this->app->register(MarkdownServiceProvider::class);
        $this->app->register(LaravelAnalyticsServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('Minify', MinifyFacade::class);
        $loader->alias('Markdown', Markdown::class);
        $loader->alias('LaravelAnalytics', LaravelAnalyticsFacade::class);
        $loader->alias('Image', Image::class);

        /*
        |--------------------------------------------------------------------------
        | Register the Commands
        |--------------------------------------------------------------------------
        */

        $this->commands([
            ThemeGenerate::class,
            ThemePublish::class,
            ModulePublish::class,
            ModuleMake::class,
            ModuleComposer::class,
            ModuleCrud::class,
            Setup::class,
            Keys::class,
        ]);
    }
}
