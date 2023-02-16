<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Services\Managements\RoleService;
use App\Statics\PermissionStatic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:" . PermissionStatic::ROLES_INDEX)->only("index");
        $this->middleware("permission:" . PermissionStatic::ROLES_EDIT)->only("edit");
    }
    public function index(RoleService $service): Response
    {
        return response()->view("managements.roles.index", $service->getAllData());
    }

    public function edit(RoleService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();

        return response()->view("managements.roles.edit", $response);
    }
}
