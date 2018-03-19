<?php

namespace Grafite\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ThemePublish extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'theme:publish {name} {--forced}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish a Cms theme\'s public assets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $fileSystem = new Filesystem();

        $files = $fileSystem->allFiles(base_path('resources/themes/'.strtolower($name).'/public'));

        foreach ($files as $file) {
            if ($file->getType() === 'file') {
                $this->line(public_path($file->getBasename()));
            }
        }

        $this->info("\n\nThese files will be overwritten\n");

        if (!$this->option('forced')) {
            $result = $this->confirm('Are you sure you want to overwrite any files of the same name?');
        } else {
            $result = true;
        }

        if ($result) {
            foreach ($files as $file) {
                $newFileName = str_replace(base_path('resources/themes/'.strtolower($name).'/public'), '', $file);
                $this->line('Copying '.public_path($newFileName).'...');
                if (is_dir($file)) {
                    $fileSystem->copyDirectory($file, public_path($newFileName));
                } else {
                    @mkdir(public_path(str_replace(basename($newFileName), '', $newFileName)), 0755, true);
                    $fileSystem->copy($file, public_path($newFileName));
                }
            }
        } else {
            $this->info("\n\nNo files were published\n");
        }
    }
}
