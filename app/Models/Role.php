<?php

namespace App\Models;

use App\Enums\Table;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Models\Role as SpatieModelRole;

class Role extends SpatieModelRole
{
    protected $table = Table::ROLES->value;
    protected $fillable = [
        "name", "guard_name", "is_mutable"
    ];
    public function formattedName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return  ucwords(str_replace("_", " ", $attributes["name"]));
            }
        );
    }
}
