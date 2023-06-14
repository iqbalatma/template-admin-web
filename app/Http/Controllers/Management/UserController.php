<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Managements\Users\UpdateUserRequest;
use App\Services\Managements\UserService;
use App\Statics\PermissionStatic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("permission:" . PermissionStatic::USERS_INDEX)->only("index");
        $this->middleware("permission:" . PermissionStatic::USERS_EDIT)->only("edit");
        $this->middleware("permission:" . PermissionStatic::USERS_UPDATE)->only("update");
    }

    /**
     * use to show view index
     *
     * @param UserService $service
     * @return Response
     */
    public function index(UserService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("managements.users.index");
    }

    /**
     * Use to show form edit
     *
     * @param UserService $service
     * @param integer $id
     * @return Response|RedirectResponse
     */
    public function edit(UserService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        viewShare($response);
        return response()->view("managements.users.edit");
    }


    /**
     * use to update data user role
     *
     * @param UserService $service
     * @param UpdateUserRequest $request
     * @param integer $id
     * @return RedirectResponse
     */
    public function update(UserService $service, UpdateUserRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("users.index")->with("success", ucfirst(trans("managements/users.messages.updateSuccess")));
    }
}
