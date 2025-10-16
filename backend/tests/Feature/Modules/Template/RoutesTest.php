<?php

namespace Tests\Feature\Modules\Template;

use Tests\TestCase;

class RoutesTest extends TestCase
{
    public function test_health_endpoint_returns_ok(): void
    {
        $response = $this->get('/api/v1/template/health');
        $response->assertStatus(200)->assertJson(['status' => 'ok']);
    }
}