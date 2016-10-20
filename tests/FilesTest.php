<?php

class FilesTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Yab\Quarx\Models\File::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'quarx/files');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('files');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'quarx/files/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'quarx/files/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertViewHas('files');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $uploadedFile = new Symfony\Component\HttpFoundation\File\UploadedFile(__DIR__.'/test-file.txt', 'test-file.txt');
        $file = factory(\Yab\Quarx\Models\File::class)->make([
            'id'       => 2,
            'location' => [
                'file_a' => [
                    'name'     => CryptoService::encrypt('test-file.txt'),
                    'original' => 'test-file.txt',
                    'mime'     => 'txt',
                    'size'     => 24,
                ],
            ],
        ]);
        $response = $this->call('POST', 'quarx/files', $file->getAttributes());
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'quarx/files/search', ['term' => 'wtf']);

        $this->assertViewHas('files');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $file = (array) factory(\Yab\Quarx\Models\File::class)->make(['id' => 3, 'title' => 'dumber']);
        $response = $this->call('PATCH', 'quarx/files/3', $file);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('/quarx/files');
    }

    public function testDelete()
    {
        Storage::put('test-file.txt', 'what is this');
        $file = factory(\Yab\Quarx\Models\File::class)->make([
            'id'       => 2,
            'location' => [
                'file_a' => [
                    'name'     => CryptoService::encrypt('test-file.txt'),
                    'original' => 'test-file.txt',
                    'mime'     => 'txt',
                    'size'     => 24,
                ],
            ],
        ]);
        $this->call('POST', 'quarx/files', $file->getAttributes());

        $response = $this->call('DELETE', 'quarx/files/2');
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertRedirectedTo('quarx/files');
    }
}
