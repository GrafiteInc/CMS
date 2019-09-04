<?php

namespace Tests\Feature;

use Tests\TestCase;

class PromotionsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Grafite\Cms\Models\Promotion::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'cms/promotions');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('promotions');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'cms/promotions/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'cms/promotions/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('promotion');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $promotion = factory(\Grafite\Cms\Models\Promotion::class)->make(['id' => 2]);
        $promotion = $promotion->toArray();
        unset($promotion['is_published']);
        unset($promotion['translations']);

        $response = $this->call('POST', 'cms/promotions', $promotion);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $promotion = ['id' => 2, 'slug' => 'dumber'];
        unset($promotion['is_published']);
        unset($promotion['translations']);
        $response = $this->call('POST', 'cms/promotions', $promotion);

        $response = $this->call('PATCH', 'cms/promotions/2', [
            'slug' => 'whacky',
            'details' => 'foobar',
        ]);


        $this->assertEquals(302, $response->getStatusCode());
        $this->assertDatabaseHas('promotions', ['slug' => 'whacky']);
    }

    public function testUpdateTranslation()
    {
        $promotion = ['id' => 2, 'slug' => 'dumber'];
        unset($promotion['is_published']);
        unset($promotion['translations']);
        $response = $this->call('POST', 'cms/promotions', $promotion);

        $response = $this->call('PATCH', 'cms/promotions/2', [
            'slug' => 'whacky',
            'details' => 'foobar',
            'lang' => 'fr',
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Grafite\\Cms\\Models\\Promotion',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'cms/promotions/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('cms/promotions');
    }
}
