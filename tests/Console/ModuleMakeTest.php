<?php

namespace Tests\Console;

use Tests\TestCase;
use org\bovigo\vfs\vfsStream;
use Grafite\CrudMaker\Generators\CrudGenerator;

class ModuleMakeTest extends TestCase
{
    protected $generator;
    protected $config;

    public function setUp(): void
    {
        parent::setUp();
        $this->generator = new CrudGenerator();
        $this->config = [
            'framework' => 'Laravel',
            'bootstrap' => false,
            'semantic' => false,
            'template_source' => __DIR__.'/../../src/Templates/CRUD',
            '_sectionPrefix_' => '',
            '_sectionTablePrefix_' => '',
            '_sectionRoutePrefix_' => '',
            '_sectionNamespace_' => '',
            'relationships' => null,
            'schema' => null,
            '_path_facade_' => vfsStream::url('Facades'),
            '_path_service_' => vfsStream::url('Services'),
            '_path_model_' => vfsStream::url('Models/'.ucfirst('testTable')),
            '_path_controller_' => vfsStream::url('Http/Controllers'),
            '_path_api_controller_' => vfsStream::url('Http/Controllers/Api'),
            '_path_views_' => vfsStream::url('resources/views'),
            '_path_tests_' => vfsStream::url('tests'),
            '_path_request_' => vfsStream::url('Http/Requests'),
            '_path_routes_' => vfsStream::url('Http/routes.php'),
            '_path_api_routes_' => vfsStream::url('Http/api-routes.php'),
            '_path_factory_' => vfsStream::url('database/factories/ModelFactory.php'),
            'routes_prefix' => '',
            'routes_suffix' => '',
            '_namespace_services_' => 'App\Services',
            '_namespace_facade_' => 'App\Facades',
            '_namespace_model_' => 'App\Models',
            '_namespace_controller_' => 'App\Http\Controllers',
            '_namespace_api_controller_' => 'App\Http\Controllers\Api',
            '_namespace_request_' => 'App\Http\Requests',
            '_lower_case_' => strtolower('testTable'),
            '_lower_casePlural_' => str_plural(strtolower('testTable')),
            '_camel_case_' => ucfirst(camel_case('testTable')),
            '_camel_casePlural_' => str_plural(camel_case('testTable')),
            '_ucCamel_casePlural_' => ucfirst(str_plural(camel_case('testTable'))),
        ];
    }

    public function testControllerGenerator()
    {
        $this->crud = vfsStream::setup('Http/Controllers');
        $this->generator->createController($this->config);

        $contents = $this->crud->getChild('Http/Controllers/TestTablesController.php');

        $this->assertTrue($this->crud->hasChild('Http/Controllers/TestTablesController.php'));
        $this->assertContains('class TestTablesController extends Controller', $contents->getContent());
    }

    public function testRequestGenerator()
    {
        $this->crud = vfsStream::setup('Http/Requests');

        $this->generator->createRequest($this->config);
        $contents = $this->crud->getChild('Http/Requests/TestTableCreateRequest.php');

        $this->assertTrue($this->crud->hasChild('Http/Requests/TestTableCreateRequest.php'));
        $this->assertContains('class TestTableCreateRequest', $contents->getContent());
    }

    public function testServiceGenerator()
    {
        $this->crud = vfsStream::setup('Services');

        $this->generator->createService($this->config);
        $contents = $this->crud->getChild('Services/TestTableService.php');

        $this->assertTrue($this->crud->hasChild('Services/TestTableService.php'));
        $this->assertContains('class TestTableService', $contents->getContent());
    }

    public function testRoutesGenerator()
    {
        $this->crud = vfsStream::setup('Http');
        file_put_contents(vfsStream::url('Http/routes.php'), 'test');

        $this->generator->createRoutes($this->config, false);
        $contents = $this->crud->getChild('Http/routes.php');

        $this->assertContains('TestTablesController', $contents->getContent());
        $this->assertContains('TestTablesController@search', $contents->getContent());
    }

    public function testViewsGenerator()
    {
        $this->crud = vfsStream::setup('resources/views');

        $this->generator->createViews($this->config);
        $contents = $this->crud->getChild('resources/views/testtables/index.blade.php');

        $this->assertTrue($this->crud->hasChild('resources/views/testtables/index.blade.php'));
        $this->assertContains('$testtable', $contents->getContent());
    }

    public function testTestGenerator()
    {
        $this->crud = vfsStream::setup('tests');

        $this->assertTrue($this->generator->createTests($this->config, false));

        $contents = $this->crud->getChild('tests/Feature/TestTableAcceptanceTest.php');
        $this->assertTrue($this->crud->hasChild('tests/Feature/TestTableAcceptanceTest.php'));
        $this->assertContains('class TestTableAcceptanceTest', $contents->getContent());

        $contents = $this->crud->getChild('tests/Unit/TestTableServiceTest.php');
        $this->assertTrue($this->crud->hasChild('tests/Unit/TestTableServiceTest.php'));
        $this->assertContains('class TestTableServiceTest', $contents->getContent());
    }

    public function testTestGeneratorServiceOnly()
    {
        $this->crud = vfsStream::setup('tests');

        $this->assertTrue($this->generator->createTests($this->config, true));

        $this->assertFalse($this->crud->hasChild('tests/Feature/TestTableAcceptanceTest.php'));

        $contents = $this->crud->getChild('tests/Unit/TestTableServiceTest.php');
        $this->assertTrue($this->crud->hasChild('tests/Unit/TestTableServiceTest.php'));
        $this->assertContains('class TestTableServiceTest', $contents->getContent());
    }

    public function testFactoryGenerator()
    {
        $this->crud = vfsStream::setup('database/factories');
        file_put_contents(vfsStream::url('database/factories/ModelFactory.php'), 'test');

        $this->generator->createFactory($this->config);
        $contents = $this->crud->getChild('database/factories/ModelFactory.php');

        $this->assertContains('TestTable::class', $contents->getContent());
        $this->assertContains('$factory->define(', $contents->getContent());
    }
}
