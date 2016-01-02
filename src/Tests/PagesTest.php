<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class PagesTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->login('admin');
        $this->migrateUp('quarx');

        factory(\Mlantz\Quarx\Models\Pages::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'quarx/pages');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('pages');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'quarx/pages/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'quarx/pages/'.Crypto::encrypt(1).'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('pages');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $pages = factory(\Mlantz\Quarx\Models\Pages::class)->make([ 'id' => 4 ]);
        $response = $this->call('POST', 'quarx/pages', $pages['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/pages');
    }

    public function testUpdate()
    {
        $pages = (array) factory(\Mlantz\Quarx\Models\Blog::class)->make([ 'id' => 3, 'title' => 'dumber' ]);
        $response = $this->call('PATCH', 'quarx/pages/'.Crypto::encrypt(3), $pages);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/pages');
    }

    public function testDelete()
    {
        $response = $this->call('GET', 'quarx/pages/'.Crypto::encrypt(1).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/pages');
    }

}

