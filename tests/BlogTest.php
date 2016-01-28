<?php

class BlogTest extends AppTest
{

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'quarx/blog');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('blogs');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'quarx/blog/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        factory(\Yab\Quarx\Models\Blog::class)->create();
        $response = $this->call('GET', 'quarx/blog/'.CryptoService::encrypt(1).'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('blog');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $blog = [ 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie' ];
        $response = $this->call('POST', 'quarx/blog', $blog);

        $this->seeInDatabase('blogs', ['id' => 1]);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/blog/'.CryptoService::encrypt(1).'/edit');
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'quarx/blog/search', ['term' => 'wtf']);

        $this->assertViewHas('blogs');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $blog = [ 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie' ];
        $this->call('POST', 'quarx/blog', $blog);

        $response = $this->call('PATCH', 'quarx/blog/'.CryptoService::encrypt(1), [
            'title' => 'dumber and dumber',
            'url' => 'dumber-and-dumber',
        ]);

        $this->seeInDatabase('blogs', ['title' => 'dumber and dumber']);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/blog/'.CryptoService::encrypt(1).'/edit');
    }

    public function testDelete()
    {
        $response = $this->call('GET', 'quarx/blog/'.Crypto::encrypt(1).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/blog');
    }

}

