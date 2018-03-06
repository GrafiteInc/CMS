<?php

namespace Tests;

class PagesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Cabin\Models\Page::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'cabin/pages');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('pages');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'cabin/pages/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'cabin/pages/1/edit');
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
        $page = factory(\Yab\Cabin\Models\Page::class)->make(['id' => 2]);
        $page = $page->toArray();
        unset($page['translations']);
        $response = $this->call('POST', 'cabin/pages', $page);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'cabin/pages/search', ['term' => 'wtf']);

        $response->assertViewHas('pages');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $page = ['id' => 2, 'title' => 'dumber', 'url' => 'dumber', 'entry' => 'okie dokie'];
        $response = $this->call('POST', 'cabin/pages', $page);

        $response = $this->call('PATCH', 'cabin/pages/2', [
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
        $response = $this->call('POST', 'cabin/pages', $page);

        $response = $this->call('PATCH', 'cabin/pages/2', [
            'title' => 'smarter',
            'url' => 'smart',
            'lang' => 'fr',
            'blocks' => null,
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Yab\\Cabin\\Models\\Page',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'cabin/pages/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('cabin/pages');
    }
}
