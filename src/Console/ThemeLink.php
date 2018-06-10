<?php

namespace Grafite\Cms\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ThemeLink extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'theme:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a symlink to your theme\'s assets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = config('cms.frontend-theme');

        $result = 'Symlink failed to generate';

        if (symlink(base_path('resources/themes/'.strtolower($name).'/public'), base_path('public/theme'))) {
            $result = 'Symlink generated';
        }

        $this->info($result);
    }
}
