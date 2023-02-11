<?php

namespace App\Repositories;

use Iqbalatma\LaravelExtend\BaseRepository;
use Spatie\Permission\Models\Permission;

class PermissionRepository extends BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = new Permission();
    }
}
