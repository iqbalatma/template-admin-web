<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Managements\Users\UpdateUserRequest;
use App\Services\Managements\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * use to show view index
     *
     * @param UserService $service
     * @return Response
     */
    public function index(UserService $service): Response
    {
        viewShare($service->getAllData());
        return response()->view("management.users.index");
    }

    /**
     * Use to show form edit
     *
     * @param UserService $service
     * @param string $id
     * @return Response|RedirectResponse
     */
    public function edit(UserService $service, string $id): Response|RedirectResponse
    {
        $response = $service->getEditDataById($id);
        if ($this->isError($response)) return $this->getErrorResponse();
        viewShare($response);
        return response()->view("management.users.edit");
    }


    /**
     * use to update data user role
     *
     * @param UserService $service
     * @param UpdateUserRequest $request
     * @param string $id
     * @return RedirectResponse
     */
    public function update(UserService $service, UpdateUserRequest $request, string $id): RedirectResponse
    {
        $response = $service->updateDataById($id, $request->validated());

        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route("management.users.index")->with("success", ucfirst(trans("managements/users.messages.updateSuccess")));
    }
}
