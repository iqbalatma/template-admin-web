<?php

namespace Tests\Feature\Managements;

use App\Models\Permission;
use App\Models\User;
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

    public function testEdit()
    {
        $this->login();
        $user = $this->getDummyUser();
        $response = $this->get(route("users.edit", $user->id));
        $response->assertStatus(JsonResponse::HTTP_OK);
    }
    public function testEditUnauthenticated()
    {
        $user = $this->getDummyUser();
        $response = $this->get(route("users.edit", $user->id));
        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirectToRoute("auth.login");
    }
    public function testEditUnauthorized()
    {
        $this->login(null);
        $user = $this->getDummyUser();
        $response = $this->get(route("users.edit", $user->id));
        $response->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }

    public function testUpdate()
    {
        $this->login();
        $user = $this->getDummyUser();
        $response = $this->put(route("users.update", $user->id), [
            "permissions" => Permission::first()
        ]);
        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirectToRoute("users.index")
            ->assertSessionHas("success", ucfirst(trans("managements/users.messages.updateSuccess")));
    }
    public function testUpdateUnauthenticated()
    {
        $user = $this->getDummyUser();
        $response = $this->put(route("users.update", $user->id), [
            "permissions" => Permission::first()
        ]);

        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirectToRoute("auth.login");
    }
    public function testUpdateUnauthorized()
    {
        $this->login(null);
        $user = $this->getDummyUser();
        $response = $this->put(route("users.update", $user->id), [
            "permissions" => Permission::first()
        ]);

        $response->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }

    private function getDummyUser(): User
    {
        return User::factory()->create();
    }
}
