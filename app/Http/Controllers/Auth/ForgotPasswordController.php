<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RequestTokenRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\Auth\ForgotPasswordService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ForgotPasswordController extends Controller
{
    /**
     * @param ForgotPasswordService $service
     * @return Response
     */
    public function showRequestForgotPassword(ForgotPasswordService $service): Response
    {
        viewShare($service->getShowRequestPasswordData());
        return response()->view("auth.show-forgot-password-request");
    }

    /**
     * @param ForgotPasswordService $service
     * @param RequestTokenRequest $request
     * @return RedirectResponse
     */
    public function requestToken(ForgotPasswordService $service, RequestTokenRequest $request): RedirectResponse
    {
        $response = $service->requestResetPassword($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with("success", "Reset password link has been sent to your email !");
    }

    /**
     * @param ForgotPasswordService $service
     * @return Response
     */
    public function showResetPassword(ForgotPasswordService $service): Response
    {
        $response = $service->getShowResetPasswordData();
        viewShare($response);
        return response()->view("auth.show-reset-password");
    }

    /**
     * @param ForgotPasswordService $service
     * @param ResetPasswordRequest $request
     * @return RedirectResponse
     */
    public function resetPassword(ForgotPasswordService $service, ResetPasswordRequest $request): RedirectResponse
    {
        $response = $service->resetPassword($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();

        return redirect()->route('auth.login')->with("success", "Reset password successfully");
    }
}
