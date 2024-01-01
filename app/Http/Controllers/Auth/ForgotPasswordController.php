<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTokenRequest;
use App\Services\Auth\ForgotPasswordService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ForgotPasswordController extends Controller
{
    /**
     * @param ForgotPasswordService $service
     * @return Response
     */
    public function showRequestForgotPassword(ForgotPasswordService $service): Response
    {
        viewShare($service->getShowRequestPasswordData());
        return response()->view("auth.forgot-password");
    }

    /**
     * @param ForgotPasswordService $service
     * @param RequestTokenRequest $request
     * @return RedirectResponse
     */
    public function requestToken(ForgotPasswordService $service, RequestTokenRequest $request):RedirectResponse
    {
        $response = $service->requestResetPassword($request->validated());
        if ($this->isError($response)) return $this->getErrorResponse();
        return redirect()->back()->with("success", "Reset password link has been sent to your email !");
    }

    // public function resetPassword(ForgotPasswordService $service, ResetPasswordRequest $request)
    // {
    //     $reseted = $service->resetPassword($request->validated());
    //     if ($reseted) {
    //         return redirect()->route("auth.login")->with("success", "Reset password successfully !");
    //     }
    //     return redirect()->route("auth.login")->with("failed", "Reset password failed !");
    // }

    // public function showResetPassword(string $email, string $token): Response
    // {
    //     return response()->view("auth.reset-password", [
    //         "title" => "Reset Password",
    //         "email" => $email,
    //         "token" => $token
    //     ]);
    // }
}
