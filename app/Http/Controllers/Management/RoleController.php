<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Managements\Roles\UpdateRoleRequest;
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
        $this->middleware("permission:" . PermissionStatic::ROLES_UPDATE)->only("update");
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

    public function update(RoleService $service, UpdateRoleRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("roles.index")->with("success", "Update role permission successfully");
    }
}
