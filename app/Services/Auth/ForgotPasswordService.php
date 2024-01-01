<?php

namespace App\Services\Auth;

use App\Contracts\Abstracts\Services\BaseService;
use Exception;
use Illuminate\Support\Facades\Password;

class ForgotPasswordService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        // $this->repository
    }


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
}
