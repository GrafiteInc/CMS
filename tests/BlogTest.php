<?php

class BlogTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Quarx\Models\Blog::class)->create();
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
        $this->see('Title');
    }

    public function testEdit()
    {
        factory(\Yab\Quarx\Models\Blog::class)->create(['id' => 4]);
        $response = $this->call('GET', 'quarx/blog/4/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('blog');
        $this->see('Title');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $blog = ['title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $response = $this->call('POST', 'quarx/blog', $blog);

        $this->seeInDatabase('blogs', ['id' => 2]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'quarx/blog/search', ['term' => 'wtf']);

        $this->assertViewHas('blogs');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $blog = ['title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $this->call('POST', 'quarx/blog', $blog);

        $response = $this->call('PATCH', 'quarx/blog/1', [
            'title' => 'dumber and dumber',
            'url'   => 'dumber-and-dumber',
        ]);

        $this->seeInDatabase('blogs', ['title' => 'dumber and dumber']);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUpdateTranslation()
    {
        $blog = ['title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $this->call('POST', 'quarx/blog', $blog);

        $response = $this->call('PATCH', 'quarx/blog/1', [
            'title' => 'dumber and dumber',
            'url'   => 'dumber-and-dumber',
            'lang'  => 'fr'
        ]);

        $this->seeInDatabase('translations', [
            'entity_type' => 'Yab\\Quarx\\Models\\Blog'
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'quarx/blog/'.Crypto::encrypt(1));
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/blog');
    }
}
