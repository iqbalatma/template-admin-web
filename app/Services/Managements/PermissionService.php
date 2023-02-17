<?php

namespace App\Services\Managements;

use App\Repositories\PermissionRepository;
use Iqbalatma\LaravelExtend\BaseService;

class PermissionService extends BaseService
{
    protected $repository;

    public function __construct()
    {
        $this->repository = new PermissionRepository();
    }

    public function getAllData(): array
    {
        return [
            "title" => ucwords(trans("managements/permissions.title")),
            "subTitle" => ucfirst(trans("managements/permissions.subtitle")),
            "cardTitle" => ucwords(trans("managements/permissions.cardTitle")),
            "permissions" => $this->repository->getAllDataPaginated()
        ];
    }
}
