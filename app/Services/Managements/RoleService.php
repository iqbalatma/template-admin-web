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
            "title" => "Roles",
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
                "title" => "Roles",
                "role" => $role,
                "permissions" => $permissions
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
            ];
        } catch (Exception $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage()
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
