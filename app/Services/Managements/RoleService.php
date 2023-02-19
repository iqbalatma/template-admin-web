<?php

namespace App\Services\Managements;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Iqbalatma\LaravelExtend\BaseService;
use Iqbalatma\LaravelExtend\Exceptions\EmptyDataException;

class RoleService extends BaseService
{
    protected $repository;
    protected $permissionRepo;

    public function __construct()
    {
        $this->repository = new RoleRepository();
        $this->permissionRepo = new PermissionRepository();
    }
    public function getAllData(): array
    {
        return [
            "title" => ucwords(trans("managements/roles.title")),
            "subTitle" => ucfirst(trans("managements/roles.subTitle")),
            "cardTitle" => ucwords(trans("managements/roles.cardTitle")),
            "roles" => $this->repository->getAllData()
        ];
    }

    public function getDataById(int $id): array
    {
        try {
            $this->checkData($id);
            $role = $this->getData();
            $permissions = $this->permissionRepo->getAllData();
            $this->setActivePermission($permissions, $role);
            $response = [
                "success" => true,
                "title" => ucwords(trans("managements/roles.title")),
                "role" => $role,
                "permissions" => $permissions
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage(),
                "tes" => $e
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => trans("general.error.somethingWentWrong")
            ];
        }

        return $response;
    }

    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $role = $this->getData();
            $role->syncPermissions($requestedData);

            $response = [
                "success" => true,
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => "Something went wrong"
            ];
        }

        return $response;
    }

    private function setActivePermission(object|null &$permissions, object $role): void
    {
        $rolePermission =  array_flip($role->permissions->pluck("name")->toArray());
        $permissions = collect($permissions)->map(function ($item) use ($rolePermission) {
            $item["is_active"] = isset($rolePermission[$item["name"]]);

            return $item;
        });
    }
}
