<?php

namespace Grafite\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputArgument;

class ModulePublish extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish a Cms module';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (is_dir(base_path(Config::get('cms.module-directory')).DIRECTORY_SEPARATOR.ucfirst($this->argument('module')).DIRECTORY_SEPARATOR.'Publishes')) {
            $fileSystem = new Filesystem();

            $files = $fileSystem->allFiles(base_path(Config::get('cms.module-directory')).DIRECTORY_SEPARATOR.ucfirst($this->argument('module')).DIRECTORY_SEPARATOR.'Publishes');
            $this->line("\n");
            foreach ($files as $file) {
                if ($file->getType() == 'file') {
                    $this->line(str_replace(base_path(Config::get('cms.module-directory')).DIRECTORY_SEPARATOR.ucfirst($this->argument('module')).DIRECTORY_SEPARATOR.'Publishes'.DIRECTORY_SEPARATOR, '', $file));
                }
            }

            $this->info("\n\nThese files will be published\n");

            $result = $this->confirm('Are you sure you want to overwrite any files of the same name?');

            if ($result) {
                foreach ($files as $file) {
                    $newFileName = str_replace(base_path(Config::get('cms.module-directory').DIRECTORY_SEPARATOR.ucfirst($this->argument('module')).DIRECTORY_SEPARATOR.'Publishes'.DIRECTORY_SEPARATOR), '', $file);
                    if (strstr($newFileName, 'resources'.DIRECTORY_SEPARATOR.'themes'.DIRECTORY_SEPARATOR)) {
                        $newFileName = str_replace(DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR.Config::get('cms.frontend-theme').DIRECTORY_SEPARATOR, $newFileName);
                        $this->line('Copying '.$newFileName.' using current Cms theme...');
                    } else {
                        $this->line('Copying '.$newFileName.'...');
                    }
                    if (is_dir($file)) {
                        $fileSystem->copyDirectory($file, base_path($newFileName));
                    } else {
                        @mkdir(base_path(str_replace(basename($newFileName), '', $newFileName)), 0755, true);
                        $fileSystem->copy($file, base_path($newFileName));
                    }
                }

                $this->info('Finished publishing this module.');
            } else {
                $this->info('You cancelled publishing this module');
            }
        } else {
            $this->line('This module may have been installed via composer, if so please run:');
            $this->info('php artisan vendor:publish');
            $this->line('You will need to ensure that you copy the published views of this module in the default theme into your custom themes.');
        }
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', null, InputArgument::REQUIRED, 'Module to publish'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
}
