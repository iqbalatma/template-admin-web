<?php

namespace App\Statics;

class PermissionStatic
{
    const PERMISSIONS = [
        [
            "name" => self::PERMISSIONS_INDEX,
            "description" => "Can show permissions index"
        ]
    ];
    const PERMISSIONS_INDEX = "permissions.index";


    const ROLES = [
        [
            "name" => self::ROLES_INDEX,
            "description" => "Can show roles index"
        ],
        [
            "name" => self::ROLES_EDIT,
            "description" => "Can show roles edit"
        ],
    ];
    const ROLES_INDEX = "roles.index";
    const ROLES_EDIT = "roles.edit";
}
