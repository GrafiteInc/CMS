<?php

namespace Mlantz\Quarx\Console;

use Config;
use Artisan;
use Illuminate\Console\Command;
use Mlantz\Laracogs\Generators\CrudGenerator;

class Module extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'quarx:module {table} {--migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a module';

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

        mkdir($moduleDirectory);
        mkdir($moduleDirectory.'/Assets');
        mkdir($moduleDirectory.'/Publishes');
        mkdir($moduleDirectory.'/Facades');
        mkdir($moduleDirectory.'/Controllers');
        mkdir($moduleDirectory.'/Migrations');
        mkdir($moduleDirectory.'/Services');
        mkdir($moduleDirectory.'/Repositories');
        mkdir($moduleDirectory.'/Models');
        mkdir($moduleDirectory.'/Views');
        mkdir($moduleDirectory.'/Tests');

        file_put_contents($moduleDirectory.'/config.php', "<?php \n\n\n return [];");
        file_put_contents($moduleDirectory.'/Views/menu.blade.php', "<li><a href=\"<?= URL::to('quarx/".strtolower(str_plural($table))."'); ?>\"><span class=\"fa fa-file\"></span> ".ucfirst(str_plural($table))."</a></li>");

        $config = [
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
            '_namespace_services_'       => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Services',
            '_namespace_facade_'         => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Facades',
            '_namespace_repository_'     => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Repositories',
            '_namespace_model_'          => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Models',
            '_namespace_controller_'     => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Controllers',
            '_namespace_request_'        => 'Quarx\Modules\\'.ucfirst(str_plural($table)).'\Requests',
            '_lower_case_'               => strtolower($table),
            '_lower_casePlural_'         => str_plural(strtolower($table)),
            '_camel_case_'               => ucfirst(camel_case($table)),
            '_camel_casePlural_'         => ucfirst(str_plural(camel_case($table))),
            'template_source'            => __DIR__.'/../Templates/',
        ];

        try {
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

            $this->line('Building facade...');
            $crudGenerator->createFacade($config);
        } catch (Exception $e) {
            throw new Exception("Unable to generate your CRUD", 1);
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
        $this->info('CRUD for '.$table.' is done.');
    }
}
