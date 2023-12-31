<?php

namespace App\Services\Auth;

use App\Contracts\Abstracts\Services\BaseService;

class ForgotPasswordService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        // $this->repository
    }


    public function getIndexData(): array
    {
        return [
            "title" => "Forgot Password"
        ];
    }
}
