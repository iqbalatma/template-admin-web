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
        [
            "name" => self::ROLES_UPDATE,
            "description" => "Can update permission of role"
        ],
    ];
    const ROLES_INDEX = "roles.index";
    const ROLES_EDIT = "roles.edit";
    const ROLES_UPDATE = "roles.update";

    const USERS = [
        [
            "name" => self::USERS_INDEX,
            "description" => "Can show users index"
        ],
        [
            "name" => self::USERS_EDIT,
            "description" => "Can show users edit"
        ],
        [
            "name" => self::USERS_UPDATE,
            "description" => "Can update data users"
        ],
    ];

    const USERS_INDEX = "users.index";
    const USERS_EDIT = "users.edit";
    const USERS_UPDATE = "users.update";
}
