<?php

class ImagesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Cabin\Models\Image::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'cabin/images');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('images');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'cabin/images/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'cabin/images/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('images');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile(__DIR__.'/test-pic.jpg', 'test-pic.jpg');
        $image = (array) factory(\Yab\Cabin\Models\Image::class)->make(['id' => 2]);
        $image['location'] = [
            [
                'name' => CryptoService::encrypt('test-pic.jpg'),
                'original' => 'what.jpg',
            ],
            [
                'name' => CryptoService::encrypt('test-pic.jpg'),
                'original' => 'what.jpg',
            ],
        ];
        $response = $this->call('POST', 'cabin/images', ['location' => $image['location']], [], []);

        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $image = (array) factory(\Yab\Cabin\Models\Image::class)->make(['id' => 3, 'title' => 'dumber']);
        $response = $this->call('PATCH', 'cabin/images/3', $image);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/cabin/images');
    }

    public function testDelete()
    {
        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile(__DIR__.'/test-pic.jpg', 'test-pic.jpg');
        $image = (array) factory(\Yab\Cabin\Models\Image::class)->make(['id' => 2]);
        $image['location'] = [
            [
                'name' => CryptoService::encrypt('files/dumb'),
                'original' => 'what.jpg',
            ],
            [
                'name' => CryptoService::encrypt('files/dumb'),
                'original' => 'what.jpg',
            ],
        ];
        $this->call('POST', 'cabin/images', $image, [], ['location' => ['image' => $uploadedFile]]);

        $response = $this->call('DELETE', 'cabin/images/2');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('cabin/images');
    }
}
