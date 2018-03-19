<?php


class TestCase extends Orchestra\Testbench\TestCase
{
    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('quarx.load-modules', false);
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        $app['config']->set('minify.config.ignore_environments', ['local', 'testing']);
        $app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');

        $app['Illuminate\Contracts\Auth\Access\Gate']->define('quarx', function ($user) {
            return true;
        });
    }

    /**
     * getPackageProviders.
     *
     * @param App $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Graphite\Quarx\QuarxProvider::class,
            \Collective\Html\HtmlServiceProvider::class,
            \Collective\Html\HtmlServiceProvider::class,
            \Graphite\Laracogs\LaracogsProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'Form' => \Collective\Html\FormFacade::class,
            'HTML' => \Collective\Html\HtmlFacade::class,
            'FormMaker' => \graphite\Laracogs\Facades\FormMaker::class,
            'InputMaker' => \graphite\Laracogs\Facades\InputMaker::class,
            'Crypto' => \graphite\Laracogs\Utilities\Crypto::class,
        ];
    }

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        $this->withFactories(__DIR__.'/../src/Models/Factories');
        $this->artisan('vendor:publish', [
            '--provider' => 'graphite\Quarx\QuarxProvider',
            '--force' => true,
        ]);
        $this->artisan('migrate', [
            '--database' => 'testbench',
        ]);
        $this->withoutMiddleware();
        $this->withoutEvents();
    }
}
