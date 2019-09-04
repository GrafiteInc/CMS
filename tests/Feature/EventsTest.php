<?php

namespace Tests\Feature;

use Tests\TestCase;

class EventsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Grafite\Cms\Models\Event::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'cms/events');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('events');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'cms/events/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'cms/events/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('event');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $event = factory(\Grafite\Cms\Models\Event::class)->make(['id' => 2]);
        $event = $event->toArray();
        unset($event['translations']);
        $response = $this->call('POST', 'cms/events', $event);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'cms/events/search', ['term' => 'wtf']);

        $response->assertViewHas('events');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $event = ['id' => 2, 'title' => 'dumber', 'start_date' => '2016-10-31', 'end_date' => '2016-10-31', 'details' => 'okie dokie'];
        $response = $this->call('POST', 'cms/events', $event);

        $response = $this->call('PATCH', 'cms/events/2', [
            'title' => 'smarter',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('events', ['title' => 'smarter']);
    }

    public function testUpdateTranslation()
    {
        $event = ['id' => 2, 'title' => 'dumber', 'start_date' => '2016-10-31', 'end_date' => '2016-10-31', 'details' => 'okie dokie'];
        $response = $this->call('POST', 'cms/events', $event);

        $response = $this->call('PATCH', 'cms/events/2', [
            'title' => 'smarter',
            'lang' => 'fr',
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Grafite\\Cms\\Models\\Event',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'cms/events/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('cms/events');
    }
}
