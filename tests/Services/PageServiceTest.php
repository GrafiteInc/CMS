<?php

namespace Tests\Services;

use Grafite\Cms\Models\Page;
use Grafite\Cms\Services\PageService;
use Tests\TestCase;

class PageServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->service = app(PageService::class);

        factory(Page::class)->create();
    }

    public function testGetPagesAsOptions()
    {
        $result = $this->service->getPagesAsOptions();

        $this->assertTrue(is_array($result));
        $this->assertEquals(1, count($result));
    }

    public function testGetTemplatesAsOptions()
    {
        $result = $this->service->getTemplatesAsOptions();

        $this->assertTrue(is_array($result));
        $this->assertEquals('show', $result[0]);
    }

    public function testGetPageName()
    {
        $result = $this->service->pageName(1);

        $this->assertEquals('dumb', $result);
    }
}
