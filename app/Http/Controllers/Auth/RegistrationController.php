<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\StoreRegistrationRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RegistrationController extends Controller
{
    /**
     * Use to show form create new user
     *
     * @param RegistrationService $service
     * @return Response
     */
    public function create(RegistrationService $service): Response
    {
        return response()->view("auth.registration", $service->getRegistrationData());
    }


    /**
     * @param RegistrationService $service
     * @param StoreRegistrationRequest $request
     * @return RedirectResponse
     */
    public function store(RegistrationService $service, StoreRegistrationRequest $request):RedirectResponse
    {
        $response = $service->addNewData($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->back()->with("success", "Registration successfully");
    }
}
