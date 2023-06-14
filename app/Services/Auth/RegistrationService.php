<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;

class RegistrationService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }
    /**
     * Use to get registration data view
     *
     * @return array
     */
    public function getRegistrationData(): array
    {
        return [
            "title" =>  "Registration"
        ];
    }

    /**
     * Use to add new data user
     *
     * @return array
     */
    public function addNewData(array $requestedData): array
    {
        try {
            $this->repository->addNewData($requestedData);
            $response = ["success" => true];
        } catch (Exception $e) {
            $response = ["success" => false, "message" => "Something went wrong"];
        }

        return $response;
    }
}
