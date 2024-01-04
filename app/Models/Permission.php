<?php

namespace App\Models;

use App\Enums\Table;
use Spatie\Permission\Models\Permission as SpatieModelPermission;

class Permission extends SpatieModelPermission
{
    protected $table = Table::PERMISSIONS->value;
    protected $fillable = [
        "name", "feature", "description", "guard_name"
    ];
}
