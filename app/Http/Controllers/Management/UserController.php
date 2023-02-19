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
        return response()->view("managements.users.index", $service->getAllData());
    }

    public function edit(UserService $service, int $id): Response|RedirectResponse
    {
        $response = $service->getDataById($id);

        if ($this->isError($response)) return $this->getErrorResponse();
        return response()->view("managements.users.edit", $response);
    }

    public function update(UserService $service, UpdateUserRequest $request, int $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("users.index")->with("success", "Update data user successfully");
    }
}
