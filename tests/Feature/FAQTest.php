<?php

namespace Tests\Feature;

use Tests\TestCase;

class FAQTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Grafite\Cms\Models\FAQ::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'cms/faqs');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('faqs');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'cms/faqs/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'cms/faqs/1'.'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('faq');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $response = $this->call('POST', 'cms/faqs', [
            'question' => 'who is this',
            'answer' => 'I am your worst nightmare!',
            'is_published' => '',
        ]);

        $this->assertDatabaseHas('faqs', ['id' => 1]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'cms/faqs/search', ['term' => 'wtf']);

        $response->assertViewHas('faqs');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', 'cms/faqs/1', [
            'question' => 'who is this',
            'answer' => 'I am your worst nightmare!',
            'is_published' => 'on',
        ]);

        $this->assertDatabaseHas('faqs', ['question' => 'who is this']);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUpdateTranslation()
    {
        $response = $this->call('PATCH', 'cms/faqs/1', [
            'question' => 'who is this',
            'answer' => 'I am your worst nightmare!',
            'is_published' => 'on',
            'lang' => 'fr',
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Grafite\\Cms\\Models\\FAQ',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'cms/faqs/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('cms/faqs');
    }
}
