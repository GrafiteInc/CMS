<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;

class FaqTest extends TestCase
{
    use WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();

        $this->login('admin');
        $this->migrateUp('quarx');

        factory(\Yab\Quarx\Models\FAQ::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'quarx/faqs');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('faqs');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'quarx/faqs/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'quarx/faqs/'.Crypto::encrypt(1).'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('faq');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $response = $this->call('POST', 'quarx/faqs', [
            'question' => 'who is this',
            'answer' => 'I am your worst nightmare!',
            'is_published' => ''
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/faqs');
    }

    public function testUpdate()
    {
        $response = $this->call('PATCH', 'quarx/faqs/'.Crypto::encrypt(1), [
            'question' => 'who is this',
            'answer' => 'I am your worst nightmare!',
            'is_published' => 'on'
        ]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/faqs/'.Crypto::encrypt(1).'/edit');
    }

    public function testDelete()
    {
        $response = $this->call('GET', 'quarx/faqs/'.Crypto::encrypt(1).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/faqs');
    }

}

