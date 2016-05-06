<?php

class PagesTest extends AppTest
{

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Quarx\Models\Pages::class)->create();
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
        $response = $this->call('GET', 'quarx/pages/'.CryptoService::encrypt(1).'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('page');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $pages = factory(\Yab\Quarx\Models\Pages::class)->make([ 'id' => 2 ]);
        $response = $this->call('POST', 'quarx/pages', $pages['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'quarx/pages/search', ['term' => 'wtf']);

        $this->assertViewHas('pages');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $pages = (array) factory(\Yab\Quarx\Models\Blog::class)->make([ 'id' => 3, 'title' => 'dumber' ]);
        $response = $this->call('PATCH', 'quarx/pages/'.CryptoService::encrypt(3), $pages);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/pages');
    }

    public function testDelete()
    {
        $response = $this->call('GET', 'quarx/pages/'.CryptoService::encrypt(1).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/pages');
    }

}

