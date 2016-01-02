<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class BlogTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
        factory(\Mlantz\Quarx\Models\Blog::class)->create();
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
        $response = $this->call('GET', 'quarx/blog/'.Crypto::encrypt(1).'/edit');
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
        $blog = (array) factory(\Mlantz\Quarx\Models\Blog::class)->make([ 'id' => 2 ]);
        $response = $this->call('POST', 'quarx/blog', $blog);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/');
    }

    public function testUpdate()
    {
        $blog = (array) factory(\Mlantz\Quarx\Models\Blog::class)->make([ 'id' => 3, 'title' => 'dumber' ]);
        $response = $this->call('PATCH', 'quarx/blog/'.Crypto::encrypt(3), $blog);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/');
    }

    public function testDelete()
    {
        $response = $this->call('GET', 'quarx/blog/'.Crypto::encrypt(1).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/blog');
    }

}

