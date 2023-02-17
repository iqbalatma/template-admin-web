<?php

namespace App\Services\Managements;

use App\Repositories\UserRepository;
use Exception;
use Iqbalatma\LaravelExtend\BaseService;

class UserService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }
    public function getAllData(): array
    {
        return [
            "title" => "Users",
            "users" => $this->repository->getAllDataPaginated()
        ];
    }

    public function getDataById(int $id): array
    {
        try {
            $this->checkData($id);

            $response = [
                "success" => true,
                "title" => "Users"
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => "Something went wrong"
            ];
        }

        return $response;
    }
}
