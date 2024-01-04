<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticateRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * @param AuthService $service
     * @return Response
     */
    public function login(AuthService $service): Response
    {
        viewShare($service->getLoginData());
        return response()->view('auth.login');
    }

    /**
     * @param AuthService $service
     * @param AuthenticateRequest $request
     * @return RedirectResponse
     */
    public function authenticate(AuthService $service, AuthenticateRequest $request): RedirectResponse
    {
        $response = $service->authenticate($request->validated());

        if ($this->isError($response))
            return $this->getErrorResponse();

        $request->session()->regenerate();
        return redirect()->intended('dashboard');
    }

    /**
     * @param AuthService $service
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(AuthService $service, Request $request): RedirectResponse
    {
        $service->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("auth.login");
    }
}
