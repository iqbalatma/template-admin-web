<?php

namespace Tests\Unit\Auth;

use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationServiceTest extends TestCase
{
    use DatabaseTransactions;
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

        $service = new AuthService();
        $response = $service->authenticate([
            "email" => $user["email"],
            "password" => $password,
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey("success", $response);
        $this->assertTrue($response["success"]);
    }

    public function testAuthenticateFailed()
    {
        $password = "admin";
        $user = [
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => Hash::make($password),
            "email_verified_at" => now()
        ];
        User::create($user);

        $service = new AuthService();
        $response = $service->authenticate([
            "email" => $user["email"],
            "password" => "wrongpassword",
        ]);

        $this->assertIsArray($response);
        $this->assertArrayHasKey("success", $response);
        $this->assertArrayHasKey("message", $response);
        $this->assertFalse($response["success"]);
        $this->assertEquals("Invalid username or password", $response["message"]);
    }

    public function testLogout()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $service = new AuthService();
        $service->logout();

        $this->assertNull(Auth::user());
    }
}
