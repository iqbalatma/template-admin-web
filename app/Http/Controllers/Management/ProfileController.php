<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Profiles\UpdateProfileRequest;
use App\Services\Managements\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    /**
     * @param ProfileService $service
     * @return Response|RedirectResponse
     */
    public function edit(ProfileService $service): Response|RedirectResponse
    {
        $response = $service->getEditData();
        if ($this->isError($response, "dashboard")) return $this->getErrorResponse();
        viewShare($response);
        return response()->view("management.profiles.edit");
    }


    /**
     * @param ProfileService $service
     * @param UpdateProfileRequest $request
     * @return RedirectResponse
     */
    public function update(ProfileService $service, UpdateProfileRequest $request): RedirectResponse
    {
        $response = $service->updateDataById($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with("success", "Memperbaharui data user berhasil !");
    }
}
