<?php

namespace App\Services\Auth;

use App\Contracts\Abstracts\Services\BaseService;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ForgotPasswordService extends BaseService
{
    /**
     * @return string[]
     */
    public function getShowRequestPasswordData(): array
    {
        return [
            "title" => "Forgot Password"
        ];
    }

    /**
     * @return string[]
     */
    public function getShowResetPasswordData(): array
    {
        return [
            "title" => "Reset Password",
        ];
    }

    /**
     * @param array $requestedData
     * @return true[]
     */
    public function requestResetPassword(array $requestedData): array
    {
        try {
            $status = Password::sendResetLink($requestedData);


            $response = $status === Password::RESET_LINK_SENT
                ? ["success" => true, "message" => __($status)]
                : ["success" => false, "message" => __($status)];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }


    /**
     * @param array $requestedData
     * @return array
     */
    public function resetPassword(array $requestedData): array
    {
        try {
            $status = Password::reset(
                $requestedData,
                function (User $user, string $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            $response = $status === Password::PASSWORD_RESET ?
                ["success" => true, "message" => __($status)] :
                ["success" => false, "message" => __($status)];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }
}
