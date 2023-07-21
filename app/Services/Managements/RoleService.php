<?php

namespace App\Services\Managements;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\BaseService;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class RoleService extends BaseService
{
    protected $repository;
    protected $permissionRepo;

    public function __construct()
    {
        $this->repository = new RoleRepository();
        $this->permissionRepo = new PermissionRepository();
    }

    /**
     * Use to provide data for index view
     *
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => ucwords(trans("managements/roles.title")),
            "subTitle" => ucfirst(trans("managements/roles.subTitle")),
            "cardTitle" => ucwords(trans("managements/roles.cardTitle")),
            "roles" => $this->repository->getAllData()
        ];
    }


    /**
     * use to provide data for edit data
     *
     * @param integer $id
     * @return array
     */
    public function getDataById(int $id): array
    {
        try {
            $this->checkData($id);
            $role = $this->getServiceEntity();
            $permissions = $this->permissionRepo->getAllData();
            $this->setActivePermission($permissions, $role);
            $permissions = $permissions->groupBy("feature");
            $response = [
                "success" => true,
                "title" => ucwords(trans("managements/roles.title")),
                "subTitle" => ucwords(trans("managements/roles.title")),
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


    /**
     * use to update data by id
     *
     * @param integer $id
     * @param array $requestedData
     * @return array
     */
    public function updateDataById(int $id, array $requestedData): array
    {
        try {
            $this->checkData($id);
            $role = $this->getServiceEntity();
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
