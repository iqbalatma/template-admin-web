<?php

namespace Tests\Feature\Managements;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\JsonResponse;
use Tests\TestCase;

class RoleControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function testIndex()
    {
        $this->login();
        $response = $this->get(route("roles.index"));

        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    public function testIndexUnauthenticated()
    {
        $response = $this->get(route("roles.index"));
        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirectToRoute("auth.login");
    }

    public function testIndexUnauthorized()
    {
        $this->login(null);
        $response = $this->get(route("roles.index"));
        $response->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }

    public function testEdit()
    {
        $this->login();
        $role = $this->getDummyRole();
        $response = $this->get(route("roles.edit", $role->id));
        $response->assertStatus(JsonResponse::HTTP_OK);
    }
    public function testEditUnauthenticated()
    {
        $role = $this->getDummyRole();
        $response = $this->get(route("roles.edit", $role->id));
        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirectToRoute("auth.login");
    }
    public function testEditUnauthorized()
    {
        $this->login(null);
        $role = $this->getDummyRole();
        $response = $this->get(route("roles.edit", $role->id));
        $response->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }

    public function testUpdate()
    {
        $this->login();
        $role = $this->getDummyRole();
        $response = $this->put(route("roles.update", $role->id), [
            "permissions" => Permission::first()
        ]);

        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirectToRoute("roles.index")
            ->assertSessionHas("success", ucfirst(trans("managements/roles.messages.updateSuccess")));
    }

    public function testUpdateUnauthenticated()
    {
        $role = $this->getDummyRole();
        $response = $this->put(route("roles.update", $role->id), [
            "permissions" => ["permissions.index"]
        ]);

        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirectToRoute("auth.login");
    }
    public function testUpdateUnauthorized()
    {
        $this->login(null);
        $role = $this->getDummyRole();
        $response = $this->put(route("roles.update", $role->id), [
            "permissions" => ["permissions.index"]
        ]);

        $response->assertStatus(JsonResponse::HTTP_FORBIDDEN);
    }


    private function getDummyRole()
    {
        return Role::create([
            "name" => fake()->name()
        ]);
    }
}
