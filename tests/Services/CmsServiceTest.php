<?php

namespace Tests\Services;

use Tests\TestCase;
use Grafite\Cms\Services\CmsService;

class CmsServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->service = app(CmsService::class);
    }
}
