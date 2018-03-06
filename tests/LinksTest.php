<?php

namespace Tests;

class LinksTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Cabin\Models\Link::class)->create();
        factory(\Yab\Cabin\Models\Link::class)->make(['id' => 1]);
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testCreate()
    {
        $response = $this->call('GET', '/cabin/links/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', '/cabin/links/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('links');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $link = factory(\Yab\Cabin\Models\Link::class)->make(['id' => 89]);
        $response = $this->call('POST', '/cabin/links', $link->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/cabin/menus/1/edit');
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', '/cabin/links/1', [
            'name' => 'wtf',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', '/cabin/links/1');
        $this->assertEquals(302, $response->getStatusCode());
    }
}
