<?php

namespace Tests\Unit\Managements;

use App\Models\Permission;
use App\Models\Role;
use App\Services\Managements\Master\RoleService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RoleServiceTest extends TestCase
{
    use DatabaseTransactions;
    public function testGetAllData()
    {
        $service = new RoleService();
        $response = $service->getAllData();

        $this->assertEquals(ucwords(trans("managements/roles.title")), $response["title"]);
        $this->assertEquals(ucfirst(trans("managements/roles.subTitle")), $response["subTitle"]);
        $this->assertEquals(ucwords(trans("managements/roles.cardTitle")), $response["cardTitle"]);
        $this->assertInstanceOf(Collection::class, $response["roles"]);
    }

    public function testGetDataById()
    {
        $service = new RoleService();
        $role = $this->getDummyRole();
        $response = $service->getDataById($role->id);

        $this->assertTrue($response["success"]);
        $this->assertEquals(ucwords(trans("managements/roles.title")), $response["title"]);
        $this->assertInstanceOf(Collection::class, $response["permissions"]);
        $this->assertInstanceOf(Role::class, $response["role"]);
    }

    public function testGetDataByIdNotFound()
    {
        $service = new RoleService();
        $role = $this->getDummyRole();
        $response = $service->getDataById($role->id + 1);

        $this->assertFalse($response["success"]);
        $this->assertEquals("Data doesn't exists !", $response["message"]);
    }

    public function testUpdateDataById()
    {
        $service = new RoleService();
        $role = $this->getDummyRole();
        $response = $service->updateDataById($role->id, [
            "permissions" => Permission::first()
        ]);

        $this->assertTrue($response["success"]);
    }

    public function testUpdateDataByIdNotFound()
    {
        $service = new RoleService();
        $role = $this->getDummyRole();
        $response = $service->updateDataById($role->id + 1, [
            "permissions" => Permission::first()
        ]);

        $this->assertFalse($response["success"]);
        $this->assertEquals("Data doesn't exists !", $response["message"]);
    }


    public function getDummyRole()
    {
        return Role::create([
            "name" => fake()->name()
        ]);
    }
}
