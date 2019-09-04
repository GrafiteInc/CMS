<?php

namespace Tests\Feature;

use Tests\TestCase;

class MenuTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Grafite\Cms\Models\Menu::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', '/cms/menus');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('menus');
    }

    public function testCreate()
    {
        $response = $this->call('GET', '/cms/menus/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', '/cms/menus/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('menu');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $menu = factory(\Grafite\Cms\Models\Menu::class)->make(['id' => 2]);
        $response = $this->call('POST', '/cms/menus', $menu->toArray());

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'cms/menus/search', ['term' => 'wtf']);

        $response->assertViewHas('menus');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', '/cms/menus/1', [
            'name' => 'awesome',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', '/cms/menus/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/cms/menus');
    }
}
