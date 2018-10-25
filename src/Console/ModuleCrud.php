<?php

namespace Grafite\Cms\Console;

use Artisan;
use Config;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Grafite\CrudMaker\Generators\CrudGenerator;

class ModuleCrud extends Command
{
    public $table;
    public $filesystem;

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
    protected $description = 'Generate a CRUD module for Cms';

    /**
     * Generate a CRUD stack.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->filesystem = new Filesystem();
        $crudGenerator = new CrudGenerator();

        $this->table = ucfirst(str_singular(strtolower($this->argument('table'))));

        $moduleDirectory = base_path('cms/Modules/'.ucfirst(str_plural($this->table)));

        $this->directorySetup();

        if (!is_dir($moduleDirectory)) {
            mkdir($moduleDirectory);
            mkdir($moduleDirectory.'/Assets', 0777, true);
            mkdir($moduleDirectory.'/Publishes', 0777, true);
            mkdir($moduleDirectory.'/Publishes/database', 0777, true);
            mkdir($moduleDirectory.'/Publishes/app/Http', 0777, true);
            mkdir($moduleDirectory.'/Publishes/routes', 0777, true);
            mkdir($moduleDirectory.'/Publishes/app/Http/Controllers/Cms', 0777, true);
            mkdir($moduleDirectory.'/Publishes/resources/themes/default', 0777, true);
            mkdir($moduleDirectory.'/Migrations', 0777, true);
            mkdir($moduleDirectory.'/Controllers', 0777, true);
            mkdir($moduleDirectory.'/Services', 0777, true);
            mkdir($moduleDirectory.'/Models', 0777, true);
            mkdir($moduleDirectory.'/Routes', 0777, true);
            mkdir($moduleDirectory.'/Views', 0777, true);
            mkdir($moduleDirectory.'/Tests', 0777, true);
            mkdir($moduleDirectory.'/Tests/Feature', 0777, true);
            mkdir($moduleDirectory.'/Tests/Unit', 0777, true);
        }

        file_put_contents($moduleDirectory.'/config.php', "<?php \n\n\n return [ 'asset_path' => __DIR__.'/Assets', 'url' => '".strtolower(str_plural($this->table))."', ];");
        file_put_contents($moduleDirectory.'/Views/menu.blade.php', "<li class=\"nav-item @if (Request::is(config('cms.backend-route-prefix', 'cms').'/".strtolower(str_plural($this->table))."') || Request::is(config('cms.backend-route-prefix', 'cms').'/".strtolower(str_plural($this->table))."/*')) active @endif\"><a class=\"nav-link\" href=\"{{ url(config('cms.backend-route-prefix', 'cms').'/".strtolower(str_plural($this->table))."') }}\"><span class=\"fa fa-fw fa-file\"></span> ".ucfirst(str_plural($this->table)).'</a></li>');

        $config = [
            'bootstrap' => false,
            'semantic' => false,
            '_path_facade_' => $moduleDirectory.'/Facades',
            '_path_service_' => $moduleDirectory.'/Services',
            '_path_model_' => $moduleDirectory.'/Models',
            '_path_model_' => $moduleDirectory.'/Models',
            '_path_controller_' => $moduleDirectory.'/Controllers',
            '_path_views_' => $moduleDirectory.'/Views',
            '_path_tests_' => $moduleDirectory.'/Tests',
            '_path_request_' => $moduleDirectory.'/Requests',
            '_path_routes_' => $moduleDirectory.'/Routes/web.php',
            'routes_prefix' => "<?php \n\nRoute::group(['namespace' => 'Cms\Modules\\".ucfirst(str_plural($this->table))."\Controllers', 'prefix' => config('cms.backend-route-prefix', 'cms'), 'middleware' => ['web', 'auth', 'cms']], function () { \n\n",
            'routes_suffix' => "\n\n});",
            '_app_namespace_' => app()->getInstance()->getNamespace(),
            '_namespace_services_' => 'Cms\Modules\\'.ucfirst(str_plural($this->table)).'\Services',
            '_namespace_facade_' => 'Cms\Modules\\'.ucfirst(str_plural($this->table)).'\Facades',
            '_namespace_model_' => 'Cms\Modules\\'.ucfirst(str_plural($this->table)).'\Models',
            '_namespace_controller_' => 'Cms\Modules\\'.ucfirst(str_plural($this->table)).'\Controllers',
            '_namespace_request_' => 'Cms\Modules\\'.ucfirst(str_plural($this->table)).'\Requests',
            '_table_name_' => str_plural(strtolower($this->table)),
            '_lower_case_' => strtolower($this->table),
            '_lower_casePlural_' => str_plural(strtolower($this->table)),
            '_camel_case_' => ucfirst(camel_case($this->table)),
            '_camel_casePlural_' => ucfirst(str_plural(camel_case($this->table))),
            '_ucCamel_casePlural_' => ucfirst(str_plural(camel_case($this->table))),
            'template_source' => __DIR__.'/../Templates/CRUD/',
            'tests_generated' => 'integration,service,repository',
        ];

        $this->makeTheProvider($config, $moduleDirectory, $this->table);

        $appConfig = $config;
        $appConfig['template_source'] = __DIR__.'/../Templates/AppCRUD';
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

            $this->line('Building model...');
            $crudGenerator->createModel($config);

            $this->line('Building request...');
            $crudGenerator->createRequest($config);

            $this->line('Building service...');
            $crudGenerator->createService($config);

            $this->line('Building views...');
            $crudGenerator->createViews($config);

            $this->line('Building routes...');
            $crudGenerator->createRoutes($config);

            $this->line('Building tests...');
            $crudGenerator->createTests($config, false);

            $this->info('Building the theme side...');

            $this->line('Building controller...');
            $crudGenerator->createController($appConfig);

            $this->line('Building views...');
            $crudGenerator->createViews($appConfig);

            $this->line('Building routes...');
            @file_put_contents($moduleDirectory.'/Publishes/routes/'.$config['_lower_casePlural_'].'-web.php', '');
            $crudGenerator->createRoutes($appConfig, false);

            $this->line('You will need to publish your module to make it available to your vistors:');
            $this->comment('php artisan module:publish '.str_plural($this->table));
            $this->line('');
            $this->info('Add this to your `app/Providers/RouteServiceProver.php` in the `mapWebRoutes` method:');
            $this->comment("\nrequire base_path('routes/".$config['_lower_casePlural_']."-web.php');\n");
        } catch (Exception $e) {
            throw new Exception('Unable to generate your Module', 1);
        }

        Artisan::call('make:migration', [
            'name' => 'create_'.str_plural(strtolower($this->table)).'_table',
            '--path' => 'cms/Modules/'.ucfirst(str_plural($this->table)).'/Migrations',
            '--table' => str_plural(strtolower($this->table)),
            '--create' => true,
        ]);

        $this->setSchema();

        $this->line('You may wish to add this as your testing database');
        $this->line("'testing' => [ 'driver' => 'sqlite', 'database' => ':memory:', 'prefix' => '' ],");
        $this->info('Module for '.$this->table.' is done.');
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
        $provider = file_get_contents(__DIR__.'/../Templates/CRUD/Provider.txt');

        foreach ($config as $key => $value) {
            $provider = str_replace($key, $value, $provider);
        }

        return file_put_contents($moduleDirectory.'/'.ucfirst(str_plural($table)).'ModuleProvider.php', $provider);
    }

    /**
     * Setup the directories for modules.
     */
    public function directorySetup()
    {
        if (!is_dir(base_path('cms'))) {
            @mkdir(base_path('cms'));
        }

        if (!is_dir(base_path('cms/Modules'))) {
            mkdir(base_path('cms/Modules'));
        }
    }

    public function setSchema()
    {
        if ($this->option('schema')) {
            $migrationFiles = $this->filesystem->allFiles(base_path('cms/Modules/'.ucfirst(str_plural($this->table)).'/Migrations'));
            $migrationName = 'create_'.str_plural(strtolower($this->table)).'_table';
            foreach ($migrationFiles as $file) {
                if (stristr($file->getBasename(), $migrationName)) {
                    $migrationData = file_get_contents($file->getPathname());
                    $parsedTable = '';

                    foreach (explode(',', $this->option('schema')) as $key => $column) {
                        $columnDefinition = explode(':', $column);
                        if ($key === 0) {
                            $parsedTable .= "\$table->$columnDefinition[1]('$columnDefinition[0]');\n";
                        } else {
                            $parsedTable .= "\t\t\t\$table->$columnDefinition[1]('$columnDefinition[0]');\n";
                        }
                    }

                    $migrationData = str_replace("\$table->increments('id');", $parsedTable, $migrationData);
                    file_put_contents($file->getPathname(), $migrationData);
                }
            }
        }
    }
}
