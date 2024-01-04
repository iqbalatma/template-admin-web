<?php

namespace App\Services\Managements\Master;

use App\Contracts\Abstracts\Services\BaseService;
use App\Repositories\PermissionRepository;

class PermissionService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new PermissionRepository();
        $this->breadcrumbs = [
            "Management" => "#",
            "Master" => "#",
            "Permissions" => route('management.master.permissions.index')
        ];
    }

    /**
     * @return array
     */
    public function getAllData(): array
    {
        return [
            "title" => ucwords(trans("managements/permissions.title")),
            "pageTitle" => ucwords(trans("managements/permissions.title")),
            "pageDescription" => ucfirst(trans("managements/permissions.subtitle")),
            "cardTitle" => ucwords(trans("managements/permissions.cardTitle")),
            "permissions" => $this->repository->getAllDataPaginated(),
            "breadcrumbs" => $this->getBreadcrumbs()
        ];
    }


    /**
     * @param object|null $permissions
     * @param object $role
     * @return void
     */
    public static function setActivePermission(object|null &$permissions, object $role): void
    {
        $rolePermission =  array_flip($role->permissions->pluck("name")->toArray());
        $permissions = collect($permissions)->map(function ($item) use ($rolePermission) {
            $item["is_active"] = isset($rolePermission[$item["name"]]);
            return $item;
        });
    }
}
