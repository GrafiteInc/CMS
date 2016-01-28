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
        $response = $this->call('GET', 'quarx/widgets/'.CryptoService::encrypt(1).'/edit');
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
        $widgets = factory(\Yab\Quarx\Models\Widgets::class)->make([ 'id' => 2 ]);
        $response = $this->call('POST', 'quarx/widgets', $widgets['attributes']);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/widgets/'.CryptoService::encrypt(2).'/edit');
    }

    public function testUpdate()
    {
        $widgets = (array) factory(\Yab\Quarx\Models\Widgets::class)->make([ 'id' => 3, 'answer' => 'dumber question' ]);
        $response = $this->call('PATCH', 'quarx/widgets/'.CryptoService::encrypt(3), $widgets);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/widgets');
    }

    public function testDelete()
    {
        $response = $this->call('GET', 'quarx/widgets/'.CryptoService::encrypt(1).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/widgets');
    }

}

