<?php

namespace Yab\Quarx\Console;

use Config;
use Artisan;
use Illuminate\Console\Command;
use Yab\Laracogs\Generators\CrudGenerator;

class ModuleCrud extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'module:crud {table} {--migration} {--schema=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a CRUD module for Quarx';

    /**
     * Generate a CRUD stack
     *
     * @return mixed
     */
    public function handle()
    {
        $crudGenerator = new CrudGenerator();

        $table = ucfirst(str_singular($this->argument('table')));

        $moduleDirectory = base_path('quarx/modules/'.ucfirst(str_plural($table)));

        if (! is_dir(base_path('quarx'))) {
            @mkdir(base_path('quarx'));
        }

        if (! is_dir(base_path('quarx/modules'))) {
            @mkdir(base_path('quarx/modules'));
        }

        @mkdir($moduleDirectory);
        @mkdir($moduleDirectory.'/Assets');
        @mkdir($moduleDirectory.'/Publishes');
        @mkdir($moduleDirectory.'/Publishes/database');
        @mkdir($moduleDirectory.'/Publishes/app/Http', 0777, true);
        @mkdir($moduleDirectory.'/Publishes/app/Http/Controllers/Quarx', 0777, true);
        @mkdir($moduleDirectory.'/Publishes/resources/themes/default', 0777, true);
        @mkdir($moduleDirectory.'/Publishes/database/migrations');
        @mkdir($moduleDirectory.'/Controllers');
        @mkdir($moduleDirectory.'/Services');
        @mkdir($moduleDirectory.'/Repositories');
        @mkdir($moduleDirectory.'/Models');
        @mkdir($moduleDirectory.'/Views');
        @mkdir($moduleDirectory.'/Tests');

        file_put_contents($moduleDirectory.'/config.php', "<?php \n\n\n return [];");
        file_put_contents($moduleDirectory.'/Views/menu.blade.php', "<li><a href=\"<?= URL::to('quarx/".strtolower(str_plural($table))."'); ?>\"><span class=\"fa fa-file\"></span> ".ucfirst(str_plural($table))."</a></li>");

        $config = [
            'bootstrap'                  => false,
            'semantic'                   => false,
            '_path_facade_'              => $moduleDirectory.'/Facades',
            '_path_service_'             => $moduleDirectory.'/Services',
            '_path_repository_'          => $moduleDirectory.'/Repositories',
            '_path_model_'               => $moduleDirectory.'/Models',
            '_path_controller_'          => $moduleDirectory.'/Controllers',
            '_path_views_'               => $moduleDirectory.'/Views',
            '_path_tests_'               => $moduleDirectory.'/Tests',
            '_path_request_'             => $moduleDirectory.'/Requests',
            '_path_routes_'              => $moduleDirectory.'/routes.php',
            'routes_prefix'              => "<?php \n\nRoute::group(['namespace' => 'Quarx\Modules\\".ucfirst(str_plural($table))."\Controllers', 'prefix' => 'quarx', 'middleware' => ['web', 'auth', 'quarx']], function () { \n\n",
            'routes_suffix'              => "\n\n});",
            '_app_namespace_'            => app()->getInstance()->getNamespace(),
            '_namespace_services_'       => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Services',
            '_namespace_facade_'         => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Facades',
            '_namespace_repository_'     => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Repositories',
            '_namespace_model_'          => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Models',
            '_namespace_controller_'     => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Controllers',
            '_namespace_request_'        => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Requests',
            '_table_name_'               => str_plural(strtolower($table)),
            '_lower_case_'               => strtolower($table),
            '_lower_casePlural_'         => str_plural(strtolower($table)),
            '_camel_case_'               => ucfirst(camel_case($table)),
            '_camel_casePlural_'         => ucfirst(str_plural(camel_case($table))),
            'template_source'            => __DIR__.'/../Templates/CRUD/',
        ];

        $appConfig = $config;
        $appConfig['template_source'] = __DIR__.'/../Templates/AppCRUD';
        $appConfig['_path_controller_'] = $moduleDirectory.'/Publishes/app/Http/Controllers/Quarx';
        $appConfig['_path_views_'] = $moduleDirectory.'/Publishes/resources/themes/default';
        $appConfig['_path_routes_'] = $moduleDirectory.'/Publishes/app/Http/'.$config['_lower_casePlural_'].'-routes.php';
        $appConfig['_namespace_controller_'] = $config['_app_namespace_'].'Http\Controllers\Quarx';
        $appConfig['routes_prefix'] = "<?php \n\nRoute::group(['namespace' => 'Quarx', 'middleware' => ['web']], function () {\n\n";
        $appConfig['routes_suffix'] = "\n\n});";

        try {
            $this->info('Building the admin side...');

            $this->line('Building controller...');
            $crudGenerator->createController($config);

            $this->line('Building repository...');
            $crudGenerator->createRepository($config);

            $this->line('Building request...');
            $crudGenerator->createRequest($config);

            $this->line('Building service...');
            $crudGenerator->createService($config);

            $this->line('Building views...');
            $crudGenerator->createViews($config);

            $this->line('Building routes...');
            $crudGenerator->createRoutes($config, false);

            $this->line('Building tests...');
            $crudGenerator->createTests($config);

            $this->info('Building the theme side...');

            $this->line('Building controller...');
            $crudGenerator->createController($appConfig);

            $this->line('Building views...');
            $crudGenerator->createViews($appConfig);

            $this->line('Building routes...');
            @file_put_contents($moduleDirectory.'/Publishes/app/Http/'.$config['_lower_casePlural_'].'-routes.php', '');
            $crudGenerator->createRoutes($appConfig, false);

            $this->info('Add this to your `app/Providers/RouteServiceProver.php` in the `mapWebRoutes` method:');
            $this->comment("\nrequire app_path('Http/".$config['_lower_casePlural_']."-routes.php');\n");
        } catch (Exception $e) {
            throw new Exception("Unable to generate your Module", 1);
        }

        if ($this->option('migration')) {
            Artisan::call('make:migration', [
                'name' => 'create_'.str_plural(strtolower($table)).'_table',
                '--path' => 'quarx/modules/'.ucfirst(str_plural($table)).'/Publishes/database/migrations',
                '--table' => str_plural(strtolower($table)),
                '--create' => true,
            ]);
        }

        $this->line('You may wish to add this as your testing database');
        $this->line("'testing' => [ 'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '' ],");
        $this->info('Module for '.$table.' is done.');
    }
}
