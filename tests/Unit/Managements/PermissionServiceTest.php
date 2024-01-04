<?php

namespace Tests\Unit\Managements;

use App\Services\Managements\Master\PermissionService;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class PermissionServiceTest extends TestCase
{
    public function testGetAllData()
    {
        $service = new PermissionService();
        $response = $service->getAllData();

        $this->assertEquals(ucwords(trans("managements/permissions.title")), $response["title"]);
        $this->assertEquals(ucfirst(trans("managements/permissions.subtitle")), $response["subTitle"]);
        $this->assertEquals(ucwords(trans("managements/permissions.cardTitle")), $response["cardTitle"]);
        $this->assertArrayHasKey("permissions", $response);
        $this->assertInstanceOf(LengthAwarePaginator::class, $response["permissions"]);
    }
}
