<?php

namespace Mlantz\Quarx\Console;

use Illuminate\Support\Str;
use Illuminate\Support\Schema;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;

class Publish extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quarx:publish';

    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Quarx modules';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $fileSystem = new Filesystem;

        $files = $fileSystem->allFiles(base_path(Config::get('quarx.module-directory')).'/'.ucfirst($this->argument('module')).'/Publishes');
        $this->line("\n");
        foreach ($files as $file) {
            $this->line($file);
        }

        $this->info("\n\nThese files will be published\n");

        $result = $this->confirm("Are you sure you want to overwrite any files of the same name?");

        if ($result) {
            foreach ($files as $file) {
                $newFileName = str_replace(base_path('quarx/modules/'.ucfirst($this->argument('module')).'/Publishes/'), '', $file);
                $this->line("Copying ".$newFileName."...");
                if (is_dir($file)) {
                    $fileSystem->copyDirectory($file, base_path($newFileName));
                } else {
                    @mkdir(base_path(str_replace(basename($newFileName), '', $newFileName)), 0755, true);
                    $fileSystem->copy($file, base_path($newFileName));
                }
            }
        }

        $this->info("Finished publishing this module.");
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
