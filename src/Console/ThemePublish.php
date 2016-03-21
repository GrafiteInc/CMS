<?php

namespace Yab\Quarx\Console;

use Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Schema;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
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

        $fileSystem = new Filesystem;

        $files = $fileSystem->allFiles(base_path('resources/themes/'.strtolower($name).'/public'));
        $this->line("\n");
        foreach ($files as $file) {
            // $this->line(str_replace(__DIR__.'/../PublishedAssets/Theme/', '', str_replace('themeTemplate', strtolower($name), $file)));
            if (file_exists($file)) {
                $this->line($file);
            }
        }

        foreach ($files as $file) {
            $newFileName = str_replace(base_path('resources/themes/'.strtolower($name).'/public'), '', $file);
            $this->line("Copying ".$newFileName."...");
            if (is_dir($file)) {
                $fileSystem->copyDirectory($file, public_path($newFileName));
            } else {
                @mkdir(public_path(str_replace(basename($newFileName), '', $newFileName)), 0755, true);
                $fileSystem->copy($file, public_path($newFileName));
            }
        }

        // $this->info("\n\nThese files will be generated\n");

        // $result = $this->confirm("Are you sure you want to generate this theme?");

        // if ($result) {
        //     foreach ($files as $file) {
        //         $newFileName = str_replace(__DIR__.'/../PublishedAssets/Theme', '', $file);
        //         $newFileName = str_replace('themeTemplate', strtolower($name), $newFileName);
        //         $this->line("Copying ".$newFileName."...");
        //         if (is_dir($file)) {
        //             $fileSystem->copyDirectory($file, base_path($newFileName));
        //         } else {
        //             @mkdir(base_path(str_replace(basename($newFileName), '', $newFileName)), 0755, true);
        //             $fileSystem->copy($file, base_path($newFileName));
        //         }
        //     }

        //     $sass = file_get_contents(base_path('resources/views/quarx/themes/'.strtolower($name).'/assets/sass/_theme.scss'));
        //     $sassRepairs = str_replace('themeTemplate', strtolower($name), $sass);
        //     file_put_contents(base_path('resources/views/quarx/themes/'.strtolower($name).'/assets/sass/_theme.scss'), $sassRepairs);

        //     $layout = file_get_contents(base_path('resources/views/quarx/themes/'.strtolower($name).'/layout/master.blade.php'));
        //     $layoutRepairs = str_replace('themeTemplate', strtolower($name), $layout);
        //     file_put_contents(base_path('resources/views/quarx/themes/'.strtolower($name).'/layout/master.blade.php'), $layoutRepairs);

        //     $this->info("Finished generating your theme");
        //     $this->line("\n");
        //     $this->info("Please add this to your gulpfile.js in the scripts elixir:");
        //     $this->comment('../../views/quarx/themes/'.strtolower($name).'/assets/js/theme.js');
        //     $this->line("\n");
        //     $this->info("Please add this to your app.scss:");
        //     $this->comment('@import "resources/views/quarx/themes/'.strtolower($name).'/assets/sass/_theme.scss"');
        // } else {
        //     $this->info("Nothing has been changed or added");
        // }
    }
}
