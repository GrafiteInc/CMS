<?php

namespace Tests\Feature;

use Tests\TestCase;

class FilesTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
        factory(\Grafite\Cms\Models\File::class)->create();
    }

    /*
    |--------------------------------------------------------------------------
    | Views
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', 'cms/files');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('files');
    }

    public function testCreate()
    {
        $response = $this->call('GET', 'cms/files/create');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testEdit()
    {
        $response = $this->call('GET', 'cms/files/1/edit');
        $this->assertEquals(200, $response->getStatusCode());
        $response->assertViewHas('files');
    }

    /*
    |--------------------------------------------------------------------------
    | Actions
    |--------------------------------------------------------------------------
    */

    public function testStore()
    {
        $uploadedFile = new \Symfony\Component\HttpFoundation\File\UploadedFile(__DIR__.'/../fixtures/test-file.txt', 'test-file.txt');
        $file = factory(\Grafite\Cms\Models\File::class)->make([
            'id' => 2,
            'location' => [
                'file_a' => [
                    'name' => \CryptoService::encrypt('test-file.txt'),
                    'original' => 'test-file.txt',
                    'mime' => 'txt',
                    'size' => 24,
                ],
            ],
        ]);
        $response = $this->call('POST', 'cms/files', $file->getAttributes());
        $this->assertEquals(302, $response->getStatusCode());
    }

    public function testSearch()
    {
        $response = $this->call('POST', 'cms/files/search', ['term' => 'wtf']);

        $response->assertViewHas('files');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testUpdate()
    {
        $file = (array) factory(\Grafite\Cms\Models\File::class)->make(['id' => 3, 'title' => 'dumber']);
        $response = $this->call('PATCH', 'cms/files/3', $file);

        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('/cms/files');
    }

    public function testDelete()
    {
        \Storage::put('test-file.txt', 'what is this');
        $file = factory(\Grafite\Cms\Models\File::class)->make([
            'id' => 2,
            'location' => [
                'file_a' => [
                    'name' => \CryptoService::encrypt('test-file.txt'),
                    'original' => 'test-file.txt',
                    'mime' => 'txt',
                    'size' => 24,
                ],
            ],
        ]);
        $this->call('POST', 'cms/files', $file->getAttributes());

        $response = $this->call('DELETE', 'cms/files/2');
        $this->assertEquals(302, $response->getStatusCode());
        $response->assertRedirect('cms/files');
    }
}
