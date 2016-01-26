<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class LinksTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->login('admin');
        $this->migrateUp('quarx');
        factory(\Yab\Quarx\Models\Links::class)->create();
        factory(\Yab\Quarx\Models\Links::class)->make([ 'id' => 1 ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testCreate()
    {
        $response = $this->call('GET', '/quarx/links/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', '/quarx/links/'.Crypto::encrypt(1).'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('links');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $link = factory(\Yab\Quarx\Models\Links::class)->make([ 'id' => 89 ]);
        $response = $this->call('POST', '/quarx/links', $link['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/menus/1/edit');
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', '/quarx/links/'.Crypto::encrypt(1), [
            'name' => 'wtf'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/links/'.Crypto::encrypt(1).'/edit');
    }

    public function testDelete()
    {
        $response = $this->call('GET', '/quarx/links/'.Crypto::encrypt(1).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/menus/'.Crypto::encrypt(1).'/edit');
    }

}

