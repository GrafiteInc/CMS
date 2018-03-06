<?php

class FAQTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Cabin\Models\FAQ::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'cabin/faqs');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('faqs');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'cabin/faqs/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'cabin/faqs/1'.'/edit');
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
        $response = $this->call('POST', 'cabin/faqs', [
            'question' => 'who is this',
            'answer' => 'I am your worst nightmare!',
            'is_published' => '',
        ]);

        $this->assertDatabaseHas('faqs', ['id' => 1]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'cabin/faqs/search', ['term' => 'wtf']);

        $response->assertViewHas('faqs');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', 'cabin/faqs/1', [
            'question' => 'who is this',
            'answer' => 'I am your worst nightmare!',
            'is_published' => 'on',
        ]);

        $this->assertDatabaseHas('faqs', ['question' => 'who is this']);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUpdateTranslation()
    {
        $response = $this->call('PATCH', 'cabin/faqs/1', [
            'question' => 'who is this',
            'answer' => 'I am your worst nightmare!',
            'is_published' => 'on',
            'lang' => 'fr',
        ]);

        $this->assertDatabaseHas('translations', [
            'entity_type' => 'Yab\\Cabin\\Models\\FAQ',
        ]);
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testDelete()
    {
        $response = $this->call('DELETE', 'cabin/faqs/1');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('cabin/faqs');
    }
}
