<?php

namespace Tests\Services;

use Grafite\Cms\Services\AssetService;
use Grafite\Cms\Services\CryptoService;
use Illuminate\Filesystem\Filesystem;
use Tests\TestCase;

class AssetServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->service = app(AssetService::class);
    }

    public function testAsPublic()
    {
        $encFileName = app(CryptoService::class)->url_encode(__DIR__.'/../fixtures/test-file.txt');

        $result = $this->service->asPublic($encFileName);

        $this->assertEquals('Illuminate\Http\Response', get_class($result));
    }

    public function testAsPreview()
    {
        copy(__DIR__.'/../fixtures/test-pic.jpg', storage_path('app/test-pic.jpg'));

        $fileSystem = app(Filesystem::class);
        $encFileName = app(CryptoService::class)->url_encode('test-pic.jpg');

        $result = $this->service->asPreview($encFileName, $fileSystem);

        $this->assertEquals('Illuminate\Http\Response', get_class($result));
    }

    public function testAsDownload()
    {
        $encFileName = app(CryptoService::class)->url_encode(__DIR__.'/test-file.txt');
        $encRealFileName = app(CryptoService::class)->url_encode('test-file.txt');

        $result = $this->service->asDownload($encFileName, $encRealFileName);

        $this->assertEquals('Illuminate\Http\Response', get_class($result));
    }

    public function testAsset()
    {
        $fileSystem = app(Filesystem::class);
        $encFileName = app(CryptoService::class)->url_encode(__DIR__.'/test-file.txt');
        $encType = app(CryptoService::class)->url_encode('plain/text');

        $result = $this->service->asset($encFileName, $encType, $fileSystem);

        $this->assertEquals('Illuminate\Http\Response', get_class($result));
    }

    public function testGetMimeType()
    {
        $result = $this->service->getMimeType('jpg');

        $this->assertEquals('image/jpeg', $result);
    }

    public function testGetFilePath()
    {
        $result = $this->service->getFilePath('test-file.txt');

        $this->assertEquals('/storage/test-file.txt', $result);
    }
}
