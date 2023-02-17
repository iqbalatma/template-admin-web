<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Services\Managements\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
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
}
