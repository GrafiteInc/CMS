<?php

class ImagesTest extends AppTest
{

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Quarx\Models\Images::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'quarx/images');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('images');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'quarx/images/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'quarx/images/'.CryptoService::encrypt(1).'/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('images');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile(__DIR__.'/test-pic.jpg', 'test-pic.jpg');
        $image = (array) factory(\Yab\Quarx\Models\Images::class)->make([ 'id' => 2 ]);
        $response = $this->call('POST', 'quarx/images', $image, [], ['location' => $uploadedFile]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/images/'.CryptoService::encrypt(2).'/edit');
    }

    public function testUpdate()
    {
        $image = (array) factory(\Yab\Quarx\Models\Images::class)->make([ 'id' => 3, 'title' => 'dumber' ]);
        $response = $this->call('PATCH', 'quarx/images/'.CryptoService::encrypt(3), $image);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/images');
    }

    public function testDelete()
    {
        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile(__DIR__.'/test-pic.jpg', 'test-pic.jpg');
        $image = (array) factory(\Yab\Quarx\Models\Images::class)->make([ 'id' => 2 ]);
        $this->call('POST', 'quarx/images', $image, [], ['location' => $uploadedFile]);

        $response = $this->call('GET', 'quarx/images/'.CryptoService::encrypt(2).'/delete');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/images');
    }

}

