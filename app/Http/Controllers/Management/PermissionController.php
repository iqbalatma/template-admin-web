<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Services\Managements\PermissionService;
use App\Statics\PermissionStatic;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    /**
     * Use to show permission index view
     *
     * @param PermissionService $service
     * @return Response
     */
    public function __invoke(PermissionService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("managements.permissions.index");
    }
}
