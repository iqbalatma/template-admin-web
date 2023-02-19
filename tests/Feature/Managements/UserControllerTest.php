<?php

namespace Tests\Feature\Managements;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        $this->login();
        $response = $this->get(route('users.index'));

        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    public function testIndexUnauthenticated()
    {
        $response = $this->get(route('users.index'));
        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirectToRoute("auth.login");
    }

    public function testIndexUnauthorized()
    {
        $this->login(null);
        $response = $this->get(route('users.index'));
        $response->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }
}
