<?php

namespace Grafite\Cms;

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
use Cms;
//use Spatie\LaravelAnalytics\LaravelAnalyticsFacade;
use Spatie\Analytics\AnalyticsFacade;
//use Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider;
use Spatie\Analytics\AnalyticsServiceProvider
use Grafite\Builder\GrafiteBuilderProvider;
use Grafite\Cms\Console\Keys;
use Grafite\Cms\Console\ModuleComposer;
use Grafite\Cms\Console\ModuleCrud;
use Grafite\Cms\Console\ModuleMake;
use Grafite\Cms\Console\ModulePublish;
use Grafite\Cms\Console\Setup;
use Grafite\Cms\Console\ThemeGenerate;
use Grafite\Cms\Console\ThemePublish;
use Grafite\Cms\Providers\CmsEventServiceProvider;
use Grafite\Cms\Providers\CmsModuleProvider;
use Grafite\Cms\Providers\CmsRouteProvider;
use Grafite\Cms\Providers\CmsServiceProvider;

class GrafiteCmsProvider extends ServiceProvider
{
    /**
     * Alias the services in the boot.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/PublishedAssets/Views/themes' => base_path('resources/themes'),
            __DIR__.'/PublishedAssets/Controllers' => app_path('Http/Controllers/Cms'),
            __DIR__.'/PublishedAssets/Migrations' => base_path('database/migrations'),
            __DIR__.'/PublishedAssets/Middleware' => app_path('Http/Middleware'),
            __DIR__.'/PublishedAssets/Routes' => base_path('routes'),
            __DIR__.'/PublishedAssets/Config' => base_path('config'),
        ]);

        $this->publishes([
            __DIR__.'/Views' => base_path('resources/views/vendor/cms'),
        ], 'backend');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $theme = Config::get('cms.frontend-theme', 'default');

        $this->loadViewsFrom(__DIR__.'/Views', 'cms');

        View::addLocation(base_path('resources/themes/'.$theme));
        View::addNamespace('cms-frontend', base_path('resources/themes/'.$theme));

        /*
        |--------------------------------------------------------------------------
        | Blade Directives
        |--------------------------------------------------------------------------
        */

        Blade::directive('theme', function ($expression) {
            if (Str::startsWith($expression, '(')) {
                $expression = substr($expression, 1, -1);
            }

            $theme = Config::get('cms.frontend-theme');
            $view = '"cms-frontend::'.str_replace('"', '', str_replace("'", '', $expression)).'"';

            return "<?php echo \$__env->make($view, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>";
        });

        Blade::directive('menu', function ($expression) {
            return "<?php echo Cms::menu($expression); ?>";
        });

        Blade::directive('block', function ($expression) {
            return "<?php echo \$page->block($expression); ?>";
        });

        Blade::directive('languages', function ($expression) {
            if (count(config('cms.languages')) > 1) {
                $languageLinks = [];
                foreach (config('cms.languages') as $key => $value) {
                    $languageLinks[] = '<a class="language-link" href="'.url(config('cms.backend-route-prefix', 'cms').'/language/set/'.$key).'">'.$value.'</a>';
                }

                $languageLinkString = implode($languageLinks);

                return "<?php echo '$languageLinkString'; ?>";
            }

            return '';
        });

        Blade::directive('modules', function ($expression) {
            return "<?php echo Cms::moduleLinks($expression); ?>";
        });

        Blade::directive('widget', function ($expression) {
            return "<?php echo Cms::widget($expression); ?>";
        });

        Blade::directive('image', function ($expression) {
            return "<?php echo Cms::image($expression); ?>";
        });

        Blade::directive('image_link', function ($expression) {
            return "<?php echo Cms::imageLink($expression); ?>";
        });

        Blade::directive('images', function ($expression) {
            return "<?php echo Cms::images($expression); ?>";
        });

        Blade::directive('edit', function ($expression) {
            return "<?php echo Cms::editBtn($expression); ?>";
        });

        Blade::directive('editBtn', function ($expression) {
            return "<?php echo Cms::editBtnSecondary($expression); ?>";
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
        $this->app->register(CmsServiceProvider::class);
        $this->app->register(CmsEventServiceProvider::class);
        $this->app->register(CmsRouteProvider::class);
        $this->app->register(CmsModuleProvider::class);

        $this->app->register(GrafiteBuilderProvider::class);
        $this->app->register(MinifyServiceProvider::class);
        $this->app->register(MarkdownServiceProvider::class);
        $this->app->register(AnalyticsServiceProvider::class);
        $this->app->register(ImageServiceProvider::class);

        $loader = AliasLoader::getInstance();

        $loader->alias('Minify', MinifyFacade::class);
        $loader->alias('Markdown', Markdown::class);
        $loader->alias('LaravelAnalytics', AnalyticsFacade::class);
		$loader->alias('Analytics', AnalyticsFacade::class);
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
