<?php

namespace Mlantz\Quarx\Console;

use Illuminate\Support\Str;
use Illuminate\Support\Schema;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Migrate extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quarx:migrate';

    protected $files;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate Quarx modules';

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
        $migrations = glob(__DIR__.'/../Migrations/*');

        if ($this->argument('module') !== 'Module to migrate') {
            $migrations = glob(base_path(Config::get('quarx.module-directory')).'/'.ucfirst($this->argument('module')).'/Migrations/*');
        }

        $this->requireFiles($migrations);

        $note = '';

        if ($this->option('rollback')) {

            $migrations = array_reverse($migrations);
            $lastestMigration = $this->resolve($migrations[0]);
            $lastestMigration->down();
            $note .= 'Rollback of '.$this->fileName($migrations[0]).' is complete'."\n";

         } elseif ($this->option('reset')) {

            $migrations = array_reverse($migrations);
            foreach ($migrations as $migration) {
                $lastestMigration = $this->resolve($migration);
                $lastestMigration->down();
            }
            $note .= 'Reset of Quarx is complete'."\n";

        } else {

            foreach ($migrations as $migration) {
                $migrationClass = $this->resolve($migration);
                $migrationClass->up();
                $note .= 'Quarx migration of '.$this->fileName($migration)."\n";
            }

        }

        $this->info($note);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['module', null, InputArgument::OPTIONAL, 'Module to migrate'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['rollback', null, InputOption::VALUE_NONE, 'Rollback the latest Quarx migration'],
            ['reset', null, InputOption::VALUE_NONE, 'Reset the Quarx'],
            ['database', null, InputOption::VALUE_OPTIONAL, 'Database to migrate'],
        ];
    }

    /**
     * Resolve a migration instance from a file.
     *
     * @param  string  $file
     * @return object
     */
    public function resolve($file)
    {
        $file = implode('_', array_slice(explode('_', $file), 4));

        $class = Str::studly($file);

        $class = preg_replace('/[0-9]+/', '', $class);

        $class = str_replace('.php', '', $class);

        return new $class;
    }

    /**
     * Require in all the migration files in a given path.
     *
     * @param  string  $path
     * @param  array   $files
     * @return void
     */
    public function requireFiles(array $files)
    {
        foreach ($files as $file) {
            require_once($file);
        }
    }

    public function fileName($file)
    {
        return basename($file);
    }
}
