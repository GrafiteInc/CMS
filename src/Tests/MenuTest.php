<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class MenuTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->login('admin');
        $this->migrateUp('quarx');
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
        $this->assertViewHas('menus');
    }

    public function testCreate()
    {
        $response = $this->call('GET', '/quarx/menus/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', '/quarx/menus/'.Crypto::encrypt(1).'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('menu');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $menu = factory(\Yab\Quarx\Models\Menu::class)->make([ 'id' => 2 ]);
        $response = $this->call('POST', '/quarx/menus', $menu['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/menus');
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', '/quarx/menus/'.Crypto::encrypt(1), [
            'name' => 'awesome'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/menus/'.Crypto::encrypt(1).'/edit');
    }

    public function testDelete()
    {
        $response = $this->call('GET', '/quarx/menus/'.Crypto::encrypt(1).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/menus');
    }

}

