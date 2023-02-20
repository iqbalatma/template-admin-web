<?php

namespace Tests\Unit\Managements;

use App\Models\Role;
use App\Models\User;
use App\Services\Managements\UserService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use DatabaseTransactions;

    public function testGetAllData()
    {
        $service = new UserService();
        $response = $service->getAllData();

        $this->assertEquals(ucfirst(trans("managements/users.title")), $response["title"]);
        $this->assertEquals(ucfirst(trans("managements/users.subTitle")), $response["subTitle"]);
        $this->assertEquals(ucwords(trans("managements/users.cardTitle")), $response["cardTitle"]);
        $this->assertInstanceOf(LengthAwarePaginator::class, $response["users"]);
    }

    public function testGetDataById()
    {
        $service = new UserService();
        $user = $this->getDummyUser();
        $response = $service->getDataById($user->id);

        $this->assertTrue($response["success"]);
        $this->assertEquals(ucfirst(trans("managements/users.title")), $response["title"]);
        $this->assertInstanceOf(User::class, $response["user"]);
        $this->assertInstanceOf(Collection::class, $response["roles"]);
    }

    public function testGetDataByIdNotFound()
    {
        $service = new UserService();
        $user = $this->getDummyUser();
        $response = $service->getDataById($user->id + 1);

        $this->assertFalse($response["success"]);
        $this->assertEquals("Data doesn't exists !", $response["message"]);
    }

    public function testUpdateDataById()
    {
        $service = new UserService();
        $user = $this->getDummyUser();
        $response = $service->updateDataById($user->id, ["roles" => Role::first()]);

        $this->assertTrue($response["success"]);
    }

    public function testUpdateDataByIdNotFound()
    {
        $service = new UserService();
        $user = $this->getDummyUser();
        $response = $service->updateDataById($user->id + 1, ["roles" => Role::first()]);

        $this->assertFalse($response["success"]);
        $this->assertEquals(ucfirst("data doesn't exists !"), $response["message"]);
    }

    private function getDummyUser(): User
    {
        return User::factory()->create();
    }
}
