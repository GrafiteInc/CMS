<?php

namespace Grafite\Cms\Console;

use Artisan;
use Config;
use Exception;
use Illuminate\Console\Command;
use Grafite\CrudMaker\Generators\CrudGenerator;

class ModuleMake extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'module:make {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a module for Cms';

    /**
     * Generate a CRUD stack.
     *
     * @return mixed
     */
    public function handle()
    {
        $crudGenerator = new CrudGenerator();

        $name = ucfirst(str_singular($this->argument('name')));

        $moduleDirectory = base_path('cms/Modules/'.ucfirst(str_plural($name)));

        if (!is_dir(base_path('cms'))) {
            @mkdir(base_path('cms'));
        }

        if (!is_dir(base_path('cms/Modules'))) {
            @mkdir(base_path('cms/Modules'));
        }

        @mkdir($moduleDirectory);
        @mkdir($moduleDirectory.'/Assets');
        @mkdir($moduleDirectory.'/Publishes');
        @mkdir($moduleDirectory.'/Publishes/app/Http', 0777, true);
        @mkdir($moduleDirectory.'/Publishes/routes', 0777, true);
        @mkdir($moduleDirectory.'/Publishes/app/Http/Controllers/Cms', 0777, true);
        @mkdir($moduleDirectory.'/Publishes/resources/themes/default', 0777, true);
        @mkdir($moduleDirectory.'/Controllers');
        @mkdir($moduleDirectory.'/Services');
        @mkdir($moduleDirectory.'/Views');
        @mkdir($moduleDirectory.'/Routes');
        @mkdir($moduleDirectory.'/Tests');

        file_put_contents($moduleDirectory.'/config.php', "<?php \n\n\nreturn [\n\t'asset_path' => __DIR__.'/Assets',\n\t'url' => '".strtolower(str_plural($name))."',\n\t'is_ignored_in_menu' => false\n];");
        file_put_contents($moduleDirectory.'/Views/menu.blade.php', "<li class=\"nav-item @if (Request::is('cms/".strtolower(str_plural($name))."') || Request::is('cms/".strtolower(str_plural($name))."/*')) active @endif\"><a class=\"nav-link\" href=\"{{ url('cms/".strtolower(str_plural($name))."') }}\"><span class=\"fa fa-fw fa-file\"></span> ".ucfirst(str_plural($name)).'</a></li>');

        $config = [
            'bootstrap' => false,
            'semantic' => false,
            '_path_service_' => $moduleDirectory.'/Services',
            '_path_controller_' => $moduleDirectory.'/Controllers',
            '_path_views_' => $moduleDirectory.'/Views',
            '_path_tests_' => $moduleDirectory.'/Tests',
            '_path_routes_' => $moduleDirectory.'/Routes/web.php',
            'routes_prefix' => "<?php \n\nRoute::group(['namespace' => 'Cms\Modules\\".ucfirst(str_plural($name))."\Controllers', 'prefix' => 'cms', 'middleware' => ['web', 'auth', 'cms']], function () { \n\n",
            'routes_suffix' => "\n\n});",
            '_app_namespace_' => app()->getInstance()->getNamespace(),
            '_namespace_services_' => 'Cms\Modules\\'.ucfirst(str_plural($name)).'\Services',
            '_namespace_controller_' => 'Cms\Modules\\'.ucfirst(str_plural($name)).'\Controllers',
            '_name_name_' => strtolower($name),
            '_lower_case_' => strtolower($name),
            '_lower_casePlural_' => str_plural(strtolower($name)),
            '_camel_case_' => ucfirst(camel_case($name)),
            '_camel_casePlural_' => ucfirst(str_plural(camel_case($name))),
            '_ucCamel_casePlural_' => ucfirst(str_plural(camel_case($name))),
            'template_source' => __DIR__.'/../Templates/Basic/',
        ];

        $this->makeTheProvider($config, $moduleDirectory, $name);

        $appConfig = $config;
        $appConfig['template_source'] = __DIR__.'/../Templates/AppBasic/';
        $appConfig['_path_controller_'] = $moduleDirectory.'/Publishes/app/Http/Controllers/Cms';
        $appConfig['_path_views_'] = $moduleDirectory.'/Publishes/resources/themes/default';
        $appConfig['_path_routes_'] = $moduleDirectory.'/Publishes/routes/'.$config['_lower_casePlural_'].'-web.php';
        $appConfig['_namespace_controller_'] = $config['_app_namespace_'].'Http\Controllers\Cms';
        $appConfig['routes_prefix'] = "<?php \n\nRoute::group(['namespace' => 'Cms', 'middleware' => ['web']], function () {\n\n";
        $appConfig['routes_suffix'] = "\n\n});";

        try {
            $this->info('Building the admin side...');

            $this->line('Building controller...');
            $crudGenerator->createController($config);

            $this->line('Building service...');
            $crudGenerator->createService($config);

            $this->line('Building views...');
            $crudGenerator->createViews($config);

            $this->line('Building routes...');
            $crudGenerator->createRoutes($config);

            $this->info('Building the theme side...');

            $this->line('Building controller...');
            $crudGenerator->createController($appConfig);

            $this->line('Building views...');
            $crudGenerator->createViews($appConfig);

            $this->line('Building routes...');
            $crudGenerator->createRoutes($appConfig);

            $this->line('You will need to publish your module to make it available to your vistors:');
            $this->comment('php artisan module:publish '.str_plural($name));
            $this->line('');
            $this->info('Add this to your `app/Providers/RouteServiceProver.php` in the `mapWebRoutes` method:');
            $this->comment("\nrequire base_path('routes/".$config['_lower_casePlural_']."-web.php');\n");
        } catch (Exception $e) {
            throw new Exception('Unable to generate your Module', 1);
        }

        $this->info('Module for '.$name.' is done.');
    }

    /**
     * Generate the provider file.
     *
     * @param array $config
     *
     * @return bool
     */
    public function makeTheProvider($config, $moduleDirectory, $table)
    {
        $provider = file_get_contents(__DIR__.'/../Templates/Basic/Provider.txt');

        foreach ($config as $key => $value) {
            $provider = str_replace($key, $value, $provider);
        }

        return file_put_contents($moduleDirectory.'/'.ucfirst(str_plural($table)).'ModuleProvider.php', $provider);
    }
}
