<?php

namespace Tests\Feature;

use Tests\TestCase;

class WidgetsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Grafite\Cms\Models\Widget::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'cms/widgets');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('widgets');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'cms/widgets/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'cms/widgets/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('widget');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $widget = factory(\Grafite\Cms\Models\Widget::class)->make(['id' => 2]);
        $widget = $widget->toArray();
        unset($widget['translations']);
        $response = $this->call('POST', 'cms/widgets', $widget);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $widget = ['id' => 2, 'name' => 'dumber', 'slug' => 'dumber'];
        $response = $this->call('POST', 'cms/widgets', $widget);

        $response = $this->call('PATCH', 'cms/widgets/2', [
            'name' => 'whacky',
            'slug' => 'whacky',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('widgets', ['name' => 'whacky']);
    }

    public function testUpdateTranslation()
    {
        $widget = ['id' => 2, 'name' => 'dumber', 'slug' => 'dumber'];
        $response = $this->call('POST', 'cms/widgets', $widget);

        $response = $this->call('PATCH', 'cms/widgets/2', [
            'name' => 'whacky',
            'slug' => 'whacky',
            'lang' => 'fr',
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Grafite\\Cms\\Models\\Widget',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'cms/widgets/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('cms/widgets');
    }
}
