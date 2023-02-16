<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Services\Managements\PermissionService;
use App\Statics\PermissionStatic;
use Illuminate\Http\Response;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:" . PermissionStatic::PERMISSIONS_INDEX)->only("__invoke");
    }
    /**
     * Use to show permission index view
     *
     * @param PermissionService $service
     * @return Response
     */
    public function __invoke(PermissionService $service): Response
    {
        return response()->view("managements.permissions.index", $service->getAllData());
    }
}
