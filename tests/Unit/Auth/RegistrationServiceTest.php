<?php

namespace Tests\Unit\Auth;

use App\Services\Auth\RegistrationService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegistrationServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetRegistrationData()
    {
        $service = new RegistrationService();
        $response = $service->getRegistrationData();

        $this->assertArrayHasKey("title", $response);
    }

    public function testAddNewData()
    {
        $service = new RegistrationService();
        $response = $service->addNewData([
            "name" => fake()->name(),
            "email" => fake()->email(),
            "password" => Hash::make("admin"),
        ]);

        $this->assertTrue($response["success"]);
    }

    public function testAddNewDataFailedDuplicateEmail()
    {
        $service = new RegistrationService();
        $email = fake()->email();
        $service->addNewData([
            "name" => fake()->name(),
            "email" => $email,
            "password" => Hash::make("admin"),
        ]);

        $response =  $service->addNewData([
            "name" => fake()->name(),
            "email" => $email,
            "password" => Hash::make("admin"),
        ]);

        $this->assertFalse($response["success"]);
        $this->assertEquals("Something went wrong", $response["message"]);
    }

    public function testAddNewDataEmptyArray()
    {
        $service = new RegistrationService();

        $response =  $service->addNewData([]);

        $this->assertFalse($response["success"]);
        $this->assertEquals("Something went wrong", $response["message"]);
    }
}
