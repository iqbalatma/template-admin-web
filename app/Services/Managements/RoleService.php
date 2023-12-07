<?php

namespace App\Services\Managements;

use App\Contracts\Abstracts\Services\BaseService;
use App\Models\Role;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Exception;
use Iqbalatma\LaravelServiceRepo\Exceptions\EmptyDataException;

class RoleService extends BaseService
{
    protected PermissionRepository $permissionRepo;

    public function __construct()
    {
        $this->repository = new RoleRepository();
        $this->permissionRepo = new PermissionRepository();
        $this->breadcrumbs = [
            "Management" => "#",
            "Roles" => route('roles.index'),
        ];
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
            "breadcrumbs" => $this->getBreadcrumbs(),
            "roles" => $this->repository->getAllData()
        ];
    }


    /**
     * use to provide data for edit data
     *
     * @param integer $id
     * @return array
     */
    public function getEditDataById(int $id): array
    {
        try {
            $this->checkData($id);
            $role = $this->getServiceEntity();

            $this->addBreadCrumbs([
                "Edit" => ""
            ]);

            $permissions = $this->permissionRepo->getAllData();
            PermissionService::setActivePermission($permissions, $role);
            $permissions = $permissions->groupBy("feature");

            $response = [
                "success" => true,
                "title" => ucwords(trans("managements/roles.title")),
                "subTitle" => ucwords(trans("managements/roles.title")),
                "role" => $role,
                "permissions" => $permissions,
                "breadcrumbs" => $this->getBreadcrumbs(),
            ];
        } catch (EmptyDataException $e) {
            $response = [
                "success" => false,
                "message" => $e->getMessage(),
                "tes" => $e
            ];
        } catch (Exception $e) {
            $response = getDefaultErrorResponse($e);
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
            /** @var Role $role */
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
            $response = getDefaultErrorResponse($e);
        }

        return $response;
    }
}
