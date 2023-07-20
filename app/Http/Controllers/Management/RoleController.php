<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Managements\Roles\UpdateRoleRequest;
use App\Services\Managements\RoleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    /**
     * use to show role data index
     *
     * @param RoleService $service
     * @return Response
     */
    public function index(RoleService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("managements.roles.index");
    }


    /**
     * Use to show form data edit
     *
     * @param RoleService $service
     * @param integer $id
     * @return Response|RedirectResponse
     */
    public function edit(RoleService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        viewShare($response);

        return response()->view("managements.roles.edit");
    }


    /**
     * Use to update data role
     *
     * @param RoleService $service
     * @param UpdateRoleRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(RoleService $service, UpdateRoleRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("roles.index")->with("success", ucfirst(trans("managements/roles.messages.updateSuccess")));
    }
}
