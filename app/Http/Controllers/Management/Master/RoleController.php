<?php

namespace App\Http\Controllers\Management\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Master\Roles\StoreRoleRequest;
use App\Http\Requests\Management\Master\Roles\UpdateRoleRequest;
use App\Services\Managements\Master\RoleService;
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
        return response()->view("management.master.roles.index");
    }


    /**
     * @param RoleService $service
     * @return Response
     */
    public function create(RoleService $service):Response
    {
        viewShare($service->getCreateData());
        return response()->view("management.master.roles.create");
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
        $response = $service->getEditDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        viewShare($response);

        return response()->view("management.master.roles.edit");
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

        return redirect()->route("management.master.roles.index")->with("success", ucfirst(trans("managements/roles.messages.updateSuccess")));
    }

    /**
     * @param RoleService $service
     * @param StoreRoleRequest $request
     * @return RedirectResponse
     */
    public function store(RoleService $service, StoreRoleRequest $request):RedirectResponse
    {
        $response = $service->addNewData($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->route("management.master.roles.index")->with("success", "Add new role successfully");
    }
}
