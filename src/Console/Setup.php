<?php

namespace graphite\Quarx\Console;

use Artisan;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use graphite\Laracogs\Traits\FileMakerTrait;

class Setup extends Command
{
    use FileMakerTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'quarx:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Quarx will setup your site';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Artisan::call('vendor:publish', [
            '--provider' => 'Graphite\Quarx\QuarxProvider',
            '--force' => true,
        ]);

        Artisan::call('vendor:publish', [
            '--provider' => 'Graphite\Builder\GraphiteBuilderProvider',
            '--force' => true,
        ]);

        $fileSystem = new Filesystem();

        $files = $fileSystem->allFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter');

        $this->line('Copying routes...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/routes', base_path('routes'));

        $this->line('Copying config...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/config', base_path('config'));

        $this->line('Copying app/Http...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/app/Http', app_path('Http'));

        $this->line('Copying app/Events...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/app/Events', app_path('Events'));

        $this->line('Copying app/Listeners...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/app/Listeners', app_path('Listeners'));

        $this->line('Copying app/Notifications...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/app/Notifications', app_path('Notifications'));

        $this->line('Copying app/Models...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/app/Models', app_path('Models'));

        $this->line('Copying app/Services...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/app/Services', app_path('Services'));

        $this->line('Copying database...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/database', base_path('database'));

        $this->line('Copying resources/views...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/resources/views', base_path('resources/views'));

        $this->line('Copying tests...');
        $this->copyPreparedFiles(getcwd().'/vendor/graphite/laracogs/src/Packages/Starter/tests', base_path('tests'));

        $this->fileManager();

        $this->info('Publishing theme');
        Artisan::call('theme:publish', [
            'name' => 'default',
            '--forced' => true,
        ]);

        $dbReady = $this->confirm('Please confirm that you have a database set and configured in your .env file.');

        if ($dbReady) {
            $this->info('Migrating database');
            Artisan::call('migrate:refresh', [
                '--force' => true,
            ]);

            $this->info('Setting roles');
            if (!Role::where('name', 'member')->first()) {
                Role::create([
                    'name' => 'member',
                    'label' => 'Member',
                ]);
                Role::create([
                    'name' => 'admin',
                    'label' => 'Admin',
                ]);
            }

            $this->info('Creating default account');
            $service = app(UserService::class);

            if (!User::where('name', 'admin')->first()) {
                $user = User::create([
                    'name' => 'Admin',
                    'email' => 'admin@example.com',
                    'password' => bcrypt('admin'),
                ]);
            }
            $service->create($user, 'admin', 'admin', false);

            $this->info('Finished setting up your site with Quarx!');
            $this->line('You can now login with the following username and password:');
            $this->comment('admin@example.com');
            $this->comment('admin');
        }

        $this->info('Please run:');
        $this->comment('npm install');
        $this->info('and:');
        $this->comment('npm run dev');
    }

    /**
     * Clean up files from the install of Laracogs etc.
     */
    public function fileManager()
    {
        $files = [
            base_path('config/auth.php'),
            base_path('config/services.php'),
        ];

        foreach ($files as $file) {
            $contents = file_get_contents($file);
            $contents = str_replace('App\User::class', 'App\Models\User::class', $contents);
            file_put_contents($file, $contents);
        }

        // Route setup
        $routeContents = file_get_contents(app_path('Providers/RouteServiceProvider.php'));
        $routeContents = str_replace("->group(base_path('routes/web.php'));", "->group(function() { \n\t\t\trequire base_path('routes/web.php');\n\t\t\trequire base_path('routes/quarx.php'); });", $routeContents);
        file_put_contents(app_path('Providers/RouteServiceProvider.php'), $routeContents);

        $routeToDashboardContents = file_get_contents(base_path('routes/web.php'));
        $routeToDashboardContents = str_replace("Route::get('/dashboard', 'PagesController@dashboard');", "Route::get('/dashboard', function(){ return Redirect::to('quarx/dashboard'); });", $routeToDashboardContents);
        file_put_contents(base_path('routes/web.php'), $routeToDashboardContents);

        // Kernel setup
        $routeContents = file_get_contents(app_path('Http/Kernel.php'));
        $routeContents = str_replace("'auth' => \Illuminate\Auth\Middleware\Authenticate::class,", "'auth' => \Illuminate\Auth\Middleware\Authenticate::class,\n\t\t'quarx' => \App\Http\Middleware\Quarx::class,\n\t\t'quarx-api' => \App\Http\Middleware\QuarxApi::class,\n\t\t'quarx-analytics' => \graphite\Quarx\Middleware\QuarxAnalytics::class,\n\t\t'quarx-language' => \App\Http\Middleware\QuarxLanguage::class,\n\t\t'admin' => \App\Http\Middleware\Admin::class,\n\t\t'active' => \App\Http\Middleware\Active::class,", $routeContents);
        file_put_contents(app_path('Http/Kernel.php'), $routeContents);

        $fileSystem = new Filesystem();

        $files = $fileSystem->allFiles(__DIR__.'/../PublishedAssets/Setup');

        foreach ($files as $file) {
            $newFileName = str_replace(__DIR__.'/../PublishedAssets/Setup', '', $file);
            if (is_dir($file)) {
                $fileSystem->copyDirectory($file, base_path($newFileName));
            } else {
                @mkdir(base_path(str_replace(basename($newFileName), '', $newFileName)), 0755, true);
                $fileSystem->copy($file, base_path($newFileName));
            }
        }

        // AuthProviders
        $authProviderContents = file_get_contents(app_path('Providers/AuthServiceProvider.php'));
        $authProviderContents = str_replace('$this->registerPolicies();', "\$this->registerPolicies();\n\t\t\Gate::define('quarx', function (\$user) {\n\t\t\treturn (\$user->roles->first()->name === 'admin');\n\t\t});\n\t\t\Gate::define('admin', function (\$user) {\n\t\t\treturn (\$user->roles->first()->name === 'admin');\n\t\t});", $authProviderContents);
        file_put_contents(app_path('Providers/AuthServiceProvider.php'), $authProviderContents);

        // Remove the teams
        $this->dropDeadFiles();

        /*
         * --------------------------------------------------------------------------
         * Drop the team routes and the active middleware
         * --------------------------------------------------------------------------
        */

        $mainRoutes = file_get_contents(base_path('routes/web.php'));
        $mainRoutes = str_replace("/*
    |--------------------------------------------------------------------------
    | Team Routes
    |--------------------------------------------------------------------------
    */

    Route::get('team/{name}', 'TeamController@showByName');
    Route::resource('teams', 'TeamController', ['except' => ['show']]);
    Route::post('teams/search', 'TeamController@search');
    Route::post('teams/{id}/invite', 'TeamController@inviteMember');
    Route::get('teams/{id}/remove/{userId}', 'TeamController@removeMember');", '', $mainRoutes);
        $mainRoutes = str_replace("['auth', 'active']", "['auth']", $mainRoutes);
        file_put_contents(base_path('routes/web.php'), $mainRoutes);

        /*
         * --------------------------------------------------------------------------
         * Drop the activate by email notification
         * --------------------------------------------------------------------------
        */

        $activateUserEmail = file_get_contents(app_path('Notifications/ActivateUserEmail.php'));
        $activateUserEmail = str_replace("'mail'", '', $activateUserEmail);
        file_put_contents(app_path('Notifications/ActivateUserEmail.php'), $activateUserEmail);

        /*
         * --------------------------------------------------------------------------
         * Clean up the user model
         * --------------------------------------------------------------------------
        */

        $userModel = file_get_contents(app_path('Models/User.php'));
        $userModel = str_replace("/**
 * Teams
 *
 * @return Relationship
 */
public function teams()
{
    return \$this->belongsToMany(Team::class);
}

/**
 * Team member
 *
 * @return boolean
 */
public function isTeamMember(\$id)
{
    \$teams = array_column(\$this->teams->toArray(), 'id');
    return array_search(\$id, \$teams) > -1;
}

/**
 * Team admin
 *
 * @return boolean
 */
public function isTeamAdmin(\$id)
{
    \$team = \$this->teams->find(\$id);
    return (int)\$team->user_id === (int)\$this->id;
}", '', $userModel);
        $userModel = str_replace("use App\Models\Team;", '', $userModel);
        file_put_contents(app_path('Models/User.php'), $userModel);

        $userService = file_get_contents(app_path('Services/UserService.php'));
        $userService = str_replace('/*
|--------------------------------------------------------------------------
| Teams
|--------------------------------------------------------------------------
*/

public function joinTeam($teamId, $userId)
{
    $team = $this->team->find($teamId);
    $user = $this->model->find($userId);

    $user->teams()->attach($team);
}

public function leaveTeam($teamId, $userId)
{
    $team = $this->team->find($teamId);
    $user = $this->model->find($userId);

    $user->teams()->detach($team);
}

public function leaveAllTeams($userId)
{
    $user = $this->model->find($userId);
    $user->teams()->detach();
}', '', $userService);
        $userService = str_replace('use App\Models\Team;', '', $userService);
        $userService = str_replace('Team $team,', '', $userService);
        $userService = str_replace('$this->team = $team;', '', $userService);
        $userService = str_replace('$this->leaveAllTeams($id);', '', $userService);
        file_put_contents(app_path('Services/UserService.php'), $userService);

        $seed = file_get_contents(base_path('database/seeds/DatabaseSeeder.php'));
        $seed = str_replace('$this->call(TeamTableSeeder::class);', '', $seed);
        file_put_contents(base_path('database/seeds/DatabaseSeeder.php'), $seed);

        $css = file_get_contents(base_path('resources/assets/sass/app.scss'));
        $css = str_replace('@import "node_modules/bootstrap-sass/assets/stylesheets/bootstrap";', '@import "node_modules/bootstrap-sass/assets/stylesheets/bootstrap";'."\n".'@import "resources/themes/default/assets/sass/_theme.scss";', $css);
        file_put_contents(base_path('resources/assets/sass/app.scss'), $css);

        $composer = file_get_contents(base_path('composer.json'));
        $composer = str_replace('"App\\": "app/",', '"App\\": "app/",'."\n".'"Quarx\\Modules\\": "quarx/modules/",', $composer);
        file_put_contents(base_path('composer.json'), $composer);
    }

    /**
     * Clean up dead files.
     */
    public function dropDeadFiles()
    {
        @unlink(app_path('Http/Controllers/PagesController.php'));
        @unlink(app_path('Http/Controllers/TeamController.php'));
        @unlink(app_path('Http/Requests/TeamCreateRequest.php'));
        @unlink(app_path('Http/Requests/TeamUpdateRequest.php'));
        @unlink(app_path('Models/Team.php'));
        @unlink(app_path('Services/TeamService.php'));
        @unlink(base_path('resources/views/dashboard.blade.php'));
        @unlink(base_path('resources/views/dashboard/main.blade.php'));
        @unlink(base_path('resources/views/dashboard/panel.blade.php'));
        @unlink(base_path('resources/views/partials/navigation.blade.php'));
        @unlink(base_path('resources/views/team/create.blade.php'));
        @unlink(base_path('resources/views/team/edit.blade.php'));
        @unlink(base_path('resources/views/team/show.blade.php'));
        @unlink(base_path('resources/views/team/index.blade.php'));
        @rmdir(base_path('resources/views/team'));
        @rmdir(base_path('resources/views/dashboard'));
    }
}
