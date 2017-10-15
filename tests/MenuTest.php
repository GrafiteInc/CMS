<?php

class MenuTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Quarx\Models\Menu::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', '/quarx/menus');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('menus');
    }

    public function testCreate()
    {
        $response = $this->call('GET', '/quarx/menus/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', '/quarx/menus/1/edit');
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
        $menu = factory(\Yab\Quarx\Models\Menu::class)->make(['id' => 2]);
        $response = $this->call('POST', '/quarx/menus', $menu->toArray());

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'quarx/menus/search', ['term' => 'wtf']);

        $response->assertViewHas('menus');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', '/quarx/menus/1', [
            'name' => 'awesome',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', '/quarx/menus/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/quarx/menus');
    }
}
