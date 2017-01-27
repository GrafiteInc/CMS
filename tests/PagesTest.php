<?php

class PagesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Quarx\Models\Page::class)->create();
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
        $response->assertViewHas('pages');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'quarx/pages/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'quarx/pages/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('page');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $pages = factory(\Yab\Quarx\Models\Page::class)->make(['id' => 2]);
        $response = $this->call('POST', 'quarx/pages', $pages['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'quarx/pages/search', ['term' => 'wtf']);

        $response->assertViewHas('pages');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $page = ['id' => 6, 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $response = $this->call('POST', 'quarx/pages', $page);

        $response = $this->call('PATCH', 'quarx/pages/6', [
            'title' => 'smarter',
            'url' => 'smart',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('pages', ['title' => 'smarter']);
    }

    public function testUpdateTranslation()
    {
        $page = ['id' => 6, 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $response = $this->call('POST', 'quarx/pages', $page);

        $response = $this->call('PATCH', 'quarx/pages/6', [
            'title' => 'smarter',
            'url' => 'smart',
            'lang' => 'fr',
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Yab\\Quarx\\Models\\Page',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'quarx/pages/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('quarx/pages');
    }
}
