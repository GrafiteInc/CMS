<?php

namespace Yab\Quarx\Console;

use Artisan;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;
use Yab\Laracogs\Traits\FileMakerTrait;

class Setup extends Command
{
    use FileMakerTrait;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'quarx:setup';

    protected $files;

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
    public function fire()
    {
        $cssReady = $this->confirm('Please confirm that you have gulp fully installed, and a database set and configured in your .env file.');

        if ($cssReady) {
            Artisan::call('vendor:publish', [
                '--provider' => 'Yab\Quarx\QuarxProvider',
                '--force'    => true,
            ]);

            Artisan::call('vendor:publish', [
                '--provider' => 'Yab\Laracogs\LaracogsProvider',
                '--force'    => true,
            ]);

            $fileSystem = new Filesystem();

            $files = $fileSystem->allFiles(__DIR__.'/../../../laracogs/src/Packages/Starter');

            $this->line('Copying app/Http...');
            $this->copyPreparedFiles(__DIR__.'/../../../laracogs/src/Packages/Starter/app/Http', app_path('Http'));

            $this->line('Copying app/Repositories...');
            $this->copyPreparedFiles(__DIR__.'/../../../laracogs/src/Packages/Starter/app/Repositories', app_path('Repositories'));

            $this->line('Copying app/Services...');
            $this->copyPreparedFiles(__DIR__.'/../../../laracogs/src/Packages/Starter/app/Services', app_path('Services'));

            $this->line('Copying database...');
            $this->copyPreparedFiles(__DIR__.'/../../../laracogs/src/Packages/Starter/database', base_path('database'));

            $this->line('Copying resources/views...');
            $this->copyPreparedFiles(__DIR__.'/../../../laracogs/src/Packages/Starter/resources/views', base_path('resources/views'));

            $this->line('Copying tests...');
            $this->copyPreparedFiles(__DIR__.'/../../../laracogs/src/Packages/Starter/tests', base_path('tests'));

            $this->line('Appending database/factory...');
            $this->createFactory();

            $files = [
                base_path('database/factories/ModelFactory.php'),
                base_path('config/auth.php'),
            ];

            foreach ($files as $file) {
                $contents = file_get_contents($file);
                $contents = str_replace('App\User::class', 'App\Repositories\User\User::class', $contents);
                file_put_contents($file, $contents);
            }

            // Route setup
            $routeContents = file_get_contents(app_path('Providers/RouteServiceProvider.php'));
            $routeContents = str_replace("require app_path('Http/routes.php');", "require app_path('Http/routes.php');\n\t\t\trequire app_path('Http/quarx-routes.php');", $routeContents);
            file_put_contents(app_path('Providers/RouteServiceProvider.php'), $routeContents);

            $routeToDashboardContents = file_get_contents(app_path('Http/routes.php'));
            $routeToDashboardContents = str_replace("Route::get('/dashboard', 'PagesController@dashboard');", "Route::get('/dashboard', function(){ return Redirect::to('quarx/dashboard'); });", $routeToDashboardContents);
            file_put_contents(app_path('Http/routes.php'), $routeToDashboardContents);

            // Kernel setup
            $routeContents = file_get_contents(app_path('Http/Kernel.php'));
            $routeContents = str_replace("'auth' => \App\Http\Middleware\Authenticate::class,", "'auth' => \App\Http\Middleware\Authenticate::class,\n\t\t'quarx' => \App\Http\Middleware\Quarx::class,\n\t\t'admin' => \App\Http\Middleware\Admin::class,", $routeContents);
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
            $authProviderContents = str_replace('$this->registerPolicies($gate);', "\$this->registerPolicies(\$gate);\n\t\t\$gate->define('quarx', function (\$user) {\n\t\t\treturn (\$user->roles->first()->name === 'admin');\n\t\t});\n\t\t\$gate->define('admin', function (\$user) {\n\t\t\treturn (\$user->roles->first()->name === 'admin');\n\t\t});", $authProviderContents);
            file_put_contents(app_path('Providers/AuthServiceProvider.php'), $authProviderContents);

            // Remove the teams
            @unlink(app_path('Http/Controllers/PagesController.php'));
            @unlink(app_path('Http/Controllers/TeamController.php'));
            @unlink(app_path('Http/Requests/TeamRequest.php'));
            @unlink(app_path('Http/Requests/UpdateTeamRequest.php'));
            @unlink(app_path('Repositories/Team/Team.php'));
            @unlink(app_path('Repositories/Team/TeamRepository.php'));
            @rmdir(app_path('Repositories/Team'));
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

            $mainRoutes = file_get_contents(app_path('Http/routes.php'));
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
            file_put_contents(app_path('Http/routes.php'), $mainRoutes);

            $userModel = file_get_contents(app_path('Repositories/User/User.php'));
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
    \$teamIds = [];

    foreach (\$this->teams->toArray() as \$team) {
        \$teamIds[] = \$team['id'];
    }

    return in_array(\$id, \$teamIds);
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
            file_put_contents(app_path('Repositories/User/User.php'), $userModel);

            $userService = file_get_contents(app_path('Services/UserService.php'));
            $userService = str_replace('/*
|--------------------------------------------------------------------------
| Teams
|--------------------------------------------------------------------------
*/

public function joinTeam($teamId, $userId)
{
   return $this->userRepo->joinTeam($teamId, $userId);
}

public function leaveTeam($teamId, $userId)
{
   return $this->userRepo->leaveTeam($teamId, $userId);
}

public function leaveAllTeams($userId)
{
   return $this->userRepo->leaveAllTeams($userId);
}', '', $userService);
            file_put_contents(app_path('Services/UserService.php'), $userService);

            passthru('composer dump');

            $css = file_get_contents(base_path('resources/assets/sass/app.scss'));
            $css = str_replace('@import "node_modules/bootstrap-sass/assets/stylesheets/bootstrap";', '@import "node_modules/bootstrap-sass/assets/stylesheets/bootstrap";'."\n".'@import "resources/themes/default/assets/sass/_theme.scss";', $css);
            file_put_contents(base_path('resources/assets/sass/app.scss'), $css);

            $composer = file_get_contents(base_path('composer.json'));
            $composer = str_replace('"App\\": "app/",', '"App\\": "app/",'."\n".'"Quarx\\": "quarx/",', $composer);
            file_put_contents(base_path('composer.json'), $composer);

            $this->info('Publishing theme');
            Artisan::call('theme:publish', [
                'name' => 'default',
                '--forced' => true
            ]);

            $this->info('Migrating database');
            Artisan::call('migrate:reset', [
                '--force' => true,
            ]);

            Artisan::call('migrate', [
                '--seed'  => true,
                '--force' => true,
            ]);

            $this->info('Finished setting up your site with Quarx');
            $this->info('Please run:');
            $this->comment('gulp');
            $this->line('You can now login with the following username and password:');
            $this->comment('admin@admin.com');
            $this->comment('admin');
        } else {
            $this->info('Please run:');
            $this->comment('npm install');
            $this->info('and:');
            $this->comment('npm install gulp -g');
        }
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

    public function createFactory()
    {
        $factory = file_get_contents(__DIR__.'/../../../laracogs/src/Packages/Starter/Factory.txt');
        $factoryPrepared = str_replace('{{App\}}', $this->getAppNamespace(), $factory);
        $factoryMaster = base_path('database/factories/ModelFactory.php');
        file_put_contents($factoryMaster, str_replace($factoryPrepared, '', file_get_contents($factoryMaster)));

        return file_put_contents($factoryMaster, $factoryPrepared, FILE_APPEND);
    }
}
