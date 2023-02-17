<?php

namespace Tests\Feature\Managements;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function testInvoke()
    {
        $this->login();
        $response = $this->get(route("permissions.index"));
        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    public function testInvokeUnauthenticated()
    {
        $response = $this->get(route("permissions.index"));
        $response->assertStatus(JsonResponse::HTTP_FOUND);
    }

    public function testInvokeUnauthorized()
    {
        $this->login(null);
        $response = $this->get(route("permissions.index"));
        $response->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }
}
