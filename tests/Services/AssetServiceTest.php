<?php

namespace Tests\Services;

use Tests\TestCase;
use Grafite\Cms\Services\AssetService;

class AssetServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->service = app(AssetService::class);
    }
}
