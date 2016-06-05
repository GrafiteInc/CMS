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
        $response = $this->call('GET', 'quarx/images/1/edit');
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
        $image['location'] = [
            [
                'name' => CryptoService::encrypt('test-pic.jpg'),
                'original' => 'what.jpg',
            ],
            [
                'name' => CryptoService::encrypt('test-pic.jpg'),
                'original' => 'what.jpg',
            ]
        ];
        $response = $this->call('POST', 'quarx/images', $image, [], ['location' => $uploadedFile]);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/images/');
    }

    public function testUpdate()
    {
        $image = (array) factory(\Yab\Quarx\Models\Images::class)->make([ 'id' => 3, 'title' => 'dumber' ]);
        $response = $this->call('PATCH', 'quarx/images/3', $image);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/images');
    }

    public function testDelete()
    {
        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile(__DIR__.'/test-pic.jpg', 'test-pic.jpg');
        $image = (array) factory(\Yab\Quarx\Models\Images::class)->make([ 'id' => 2 ]);
        $image['location'] = [
            [
                'name' => CryptoService::encrypt('files/dumb'),
                'original' => 'what.jpg',
            ],
            [
                'name' => CryptoService::encrypt('files/dumb'),
                'original' => 'what.jpg',
            ]
        ];
        $this->call('POST', 'quarx/images', $image, [], ['location' => ['image' => $uploadedFile]]);

        $response = $this->call('DELETE', 'quarx/images/2');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/images');
    }

}

