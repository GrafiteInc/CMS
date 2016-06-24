<?php

class WidgetsTest extends AppTest
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Quarx\Models\Widgets::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'quarx/widgets');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('widgets');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'quarx/widgets/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'quarx/widgets/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('widgets');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $widgets = factory(\Yab\Quarx\Models\Widgets::class)->make(['id' => 2]);
        $response = $this->call('POST', 'quarx/widgets', $widgets['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $widget = ['id' => 8, 'name' => 'dumber', 'slug' => 'dumber'];
        $response = $this->call('POST', 'quarx/widgets', $widget);

        $response = $this->call('PATCH', 'quarx/widgets/8', [
            'name' => 'whacky',
            'slug' => 'whacky',
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->seeInDatabase('widgets', ['name' => 'whacky']);
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'quarx/widgets/1');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/widgets');
    }
}
