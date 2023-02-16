<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieModelRole;

class Role extends SpatieModelRole
{

    public function formattedName(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return  ucwords(str_replace("_", " ", $attributes["name"]));
            }
        );
    }
}
