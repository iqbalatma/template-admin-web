<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;
    public function testLogin()
    {
        $response = $this->get("login");

        $response->assertStatus(JsonResponse::HTTP_OK);
    }

    public function testAuthenticate()
    {
        $password = "admin";
        $user = [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => Hash::make($password),
            "email_verified_at" => now()
        ];
        User::create($user);

        $response = $this->post("authenticate", [
            "email" => $user["email"],
            "password" => $password
        ]);

        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertRedirect(route("dashboard.index"));
    }

    public function testAuthenticateFailed()
    {
        $response = $this->post("authenticate", [
            "email" => "wrongemail@gmail.com",
            "password" => "wrongpassword"
        ]);

        $response->assertStatus(JsonResponse::HTTP_FOUND)
            ->assertSessionHasErrors(["errors" => "Invalid username or password"])
            ->assertRedirect("/");
    }
}
