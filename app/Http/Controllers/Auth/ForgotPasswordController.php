<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ResetTokenRequest;
use App\Http\Services\Auth\ForgotPasswordService;
use Illuminate\Http\Response;

class ForgotPasswordController extends Controller
{
    public function index(ForgotPasswordService $service): Response
    {
        return response()->view("auth.forgot-password");
    }

    public function requestToken(ForgotPasswordService $service, ResetTokenRequest $request)
    {
        $reseted = $service->requestToken($request->validated());
        if ($reseted) {
            return redirect()->back()->with("success", "Reset password link has been sent to your email !");
        }
        return redirect()->back()->with("failed", "Reset password failed !");
    }

    public function resetPassword(ForgotPasswordService $service, ResetPasswordRequest $request)
    {
        $reseted = $service->resetPassword($request->validated());
        if ($reseted) {
            return redirect()->route("auth.login")->with("success", "Reset password successfully !");
        }
        return redirect()->route("auth.login")->with("failed", "Reset password failed !");
    }

    public function showResetPassword(string $email, string $token): Response
    {
        return response()->view("auth.reset-password", [
            "title" => "Reset Password",
            "email" => $email,
            "token" => $token
        ]);
    }
}
