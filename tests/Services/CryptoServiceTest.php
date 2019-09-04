<?php

namespace Tests\Services;

use Tests\TestCase;
use Grafite\Cms\Services\CryptoService;

class CryptoServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->service = app(CryptoService::class);
    }


    public function testEncrypt()
    {
        $result = $this->service->encrypt('test');

        $this->assertContains('--', $result);
    }

    public function testDecrypt()
    {
        $value = $this->service->encrypt('test');

        $result = $this->service->decrypt($value);

        $this->assertEquals('test', $result);
    }
}
