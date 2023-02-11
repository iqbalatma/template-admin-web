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

    public function getAllData()
    {
        return [
            "title" => "Permissions",
            "permissions" => $this->repository->getAllDataPaginated()
        ];
    }
}
