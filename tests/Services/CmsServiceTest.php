<?php

namespace Tests\Services;

use Grafite\Cms\Services\CmsService;
use Tests\TestCase;

class CmsServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->service = app(CmsService::class);
    }

    public function testDefaultLanguage()
    {
        $result = $this->service->isDefaultLanguage();

        $this->assertTrue($result);
    }

    public function testNotifications()
    {
        $result = $this->service->notification('testing');

        $this->assertTrue(is_null($result));
        $this->assertEquals('testing', session()->get('notification'));
    }

    public function testBreadcrumbs()
    {
        $result = $this->service->breadcrumbs(['module']);

        $this->assertEquals('<li class="breadcrumb-item">Module</li>', $result);
    }
}
