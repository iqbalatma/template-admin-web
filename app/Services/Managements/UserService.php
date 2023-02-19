<?php

namespace App\Services\Managements;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Iqbalatma\LaravelExtend\BaseService;

class UserService extends BaseService
{
    protected $repository;
    protected $roleRepo;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->roleRepo = new RoleRepository();
    }
    public function getAllData(): array
    {
        return [
            "title" => ucfirst(trans("managements/users.title")),
            "subTitle" => ucfirst(trans("managements/users.subTitle")),
            "cardTitle" => ucwords(trans("managements/users.cardTitle")),
            "users" => $this->repository->getAllDataPaginated()
        ];
    }

    public function getDataById(int $id): array
    {
        try {
            $this->checkData($id);
            $user = $this->getData();
            $roles = $this->roleRepo->getAllData();
            $this->setActiveRole($roles, $user);
            $response = [
                "success" => true,
                "title" => "Users",
                "user" => $user,
                "roles" => $roles
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => "Something went wrong"
            ];
        }

        return $response;
    }

    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $user = $this->getData();

            $user->syncRoles($requestedData);

            $response = [
                "success" => true,
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
        return $response;
    }
    private function setActiveRole(object &$roles, object $user): void
    {
        $userRoles = array_flip($user->roles->pluck("name")->toArray());
        $roles = collect($roles)->map(function ($item) use ($userRoles) {
            $item["is_active"] = isset($userRoles[$item["name"]]);
            return $item;
        });
    }
}
