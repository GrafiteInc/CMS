<?php

namespace Grafite\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;

class ModuleComposer extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'module:composer {module} {namespace} {--directory=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Convert a Cms module to a composer package';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $moduleDir = base_path(config('cms.module-directory')).'/'.ucfirst($this->argument('module'));
        if (is_dir($moduleDir)) {
            $readMeStub = file_get_contents(__DIR__.'/../Templates/Composer/readme.stub');
            $composerStub = file_get_contents(__DIR__.'/../Templates/Composer/composer.stub');
            $packageDir = $this->option('directory');
            $namespace = $this->argument('namespace');
            $module = $this->argument('module');
            $system = app(Filesystem::class);

            if (is_null($packageDir)) {
                $packageDir = $moduleDir.'/../../packages/'.ucfirst($module);
            }

            if (!is_dir($moduleDir.'/../../packages/')) {
                $system->makeDirectory($moduleDir.'/../../packages/');
            }

            if (!is_dir($packageDir)) {
                $system->makeDirectory($packageDir);
            }

            $system->put($packageDir.'/README.md', $readMeStub);
            $system->put($packageDir.'/composer.json', $composerStub);

            $this->copyModuleToPackageDir($moduleDir, $packageDir);

            $files = $system->glob($packageDir.'/*');

            foreach ($files as $file) {
                if ($system->isFile($file)) {
                    $this->updateFile($file, $namespace, $module);
                }
            }

            $this->line('Your comploser package is now complete.');
        } else {
            $this->line('We\'ve encountered an issue, please check you spelled the module name correctly');
        }
    }

    public function updateFile($file, $namespace, $module)
    {
        $system = app(Filesystem::class);
        $contents = $system->get($file);

        $provider = explode('\\', $namespace);
        $escapaedNamespace = str_replace('\\', '\\\\', $namespace);

        $contents = str_replace('{package}', strtolower($provider[0]).'/'.strtolower($module), $contents);
        $contents = str_replace('{module}', strtolower($module), $contents);
        $contents = str_replace('{namespace}', $namespace, $contents);
        $contents = str_replace('{escapedNamespace}', $escapaedNamespace, $contents);
        $contents = str_replace('Cms\\Modules', $provider[0], $contents);

        $system->put($file, $contents);
    }

    public function copyModuleToPackageDir($moduleDir, $packageDir)
    {
        $system = app(Filesystem::class);
        $system->copyDirectory($moduleDir, $packageDir);
    }
}
