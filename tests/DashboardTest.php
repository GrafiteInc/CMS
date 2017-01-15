<?php

class DashboardTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware();
        $this->withoutEvents();
    }

    /*
    |--------------------------------------------------------------------------
    | Landing
    |--------------------------------------------------------------------------
    */

    public function testIndex()
    {
        $response = $this->call('GET', '/quarx/dashboard');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
