<?php

namespace Tests\Feature;

use Tests\TestCase;

class LinksTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Grafite\Cms\Models\Menu::class)->create();
        factory(\Grafite\Cms\Models\Link::class)->create();
        factory(\Grafite\Cms\Models\Link::class)->make(['id' => 1]);
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testCreate()
    {
        $response = $this->call('GET', '/cms/links/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', '/cms/links/1/edit');
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
        $link = factory(\Grafite\Cms\Models\Link::class)->make(['id' => 89]);
        $response = $this->call('POST', '/cms/links', $link->toArray());

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/cms/menus/1/edit');
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', '/cms/links/1', [
            'name' => 'wtf',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', '/cms/links/1');
        $this->assertEquals(302, $response->getStatusCode());
    }
}
