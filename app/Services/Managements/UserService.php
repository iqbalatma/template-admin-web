<?php

namespace App\Services\Managements;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class UserService extends BaseService
{
    protected $repository;
    protected $roleRepo;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->roleRepo = new RoleRepository();
    }

    /**
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => ucfirst(trans("managements/users.title")),
            "subTitle" => ucfirst(trans("managements/users.subTitle")),
            "cardTitle" => ucwords(trans("managements/users.cardTitle")),
            "users" => $this->repository->getAllDataPaginated()
        ];
    }


    /**
     * @param int $id
     * @return array
     */
    public function getDataById(int $id): array
    {
        try {
            $this->checkData($id);
            $user = $this->getServiceEntity();
            $roles = $this->roleRepo->getAllData();
            $this->setActiveRole($roles, $user);
            $response = [
                "success" => true,
                "subTitle" => ucfirst(trans("managements/users.subTitle")),
                "title" => ucfirst(trans("managements/users.title")),
                "user" => $user,
                "roles" => $roles
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => ucfirst($e->getMessage())
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }


    /**
     * @param int $id
     * @param array $requestedData
     * @return array|true[]
     */
    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $user = $this->getServiceEntity();
            $user->syncRoles($requestedData);

            $response = [
                "success" => true,
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => ucfirst($e->getMessage())
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
        }
        return $response;
    }


    /**
     * @param object $roles
     * @param object $user
     * @return void
     */
    private function setActiveRole(object &$roles, object $user): void
    {
        $userRoles = array_flip($user->roles->pluck("name")->toArray());
        $roles = collect($roles)->map(function ($item) use ($userRoles) {
            $item["is_active"] = isset($userRoles[$item["name"]]);
            return $item;
        });
    }
}
