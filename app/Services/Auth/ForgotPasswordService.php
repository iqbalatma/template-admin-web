<?php

namespace App\Services\Auth;

use App\Contracts\Abstracts\Services\BaseService;
use Exception;

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
            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }
}
