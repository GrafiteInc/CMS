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
        $page = factory(\Yab\Quarx\Models\Page::class)->make(['id' => 2]);
        $page = $page->toArray();
        unset($page['translations']);
        $response = $this->call('POST', 'quarx/pages', $page);

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
        $page = ['id' => 2, 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $response = $this->call('POST', 'quarx/pages', $page);

        $response = $this->call('PATCH', 'quarx/pages/2', [
            'title' => 'smarter',
            'url' => 'smart',
            'blocks' => null,
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('pages', ['title' => 'smarter']);
    }

    public function testUpdateTranslation()
    {
        $page = ['id' => 2, 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $response = $this->call('POST', 'quarx/pages', $page);

        $response = $this->call('PATCH', 'quarx/pages/2', [
            'title' => 'smarter',
            'url' => 'smart',
            'lang' => 'fr',
            'blocks' => null,
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
