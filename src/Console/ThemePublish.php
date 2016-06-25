<?php

namespace Yab\Quarx\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ThemePublish extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'theme:publish {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish a Quarx theme\'s public assets';

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
        $this->line("\n");
        foreach ($files as $file) {
            if (file_exists($file)) {
                $this->line($file);
            }
        }

        foreach ($files as $file) {
            $newFileName = str_replace(base_path('resources/themes/'.strtolower($name).'/public'), '', $file);
            $this->line('Copying '.$newFileName.'...');
            if (is_dir($file)) {
                $fileSystem->copyDirectory($file, public_path($newFileName));
            } else {
                @mkdir(public_path(str_replace(basename($newFileName), '', $newFileName)), 0755, true);
                $fileSystem->copy($file, public_path($newFileName));
            }
        }
    }
}
