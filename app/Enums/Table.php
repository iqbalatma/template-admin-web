<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;

enum Table:string
{
    use InvokableCases;

    case USERS = "users";
    case ROLES = "roles";
    case PERMISSIONS = "permissions";
    case ROLE_HAS_PERMISSIONS = "role_has_permissions";
    case MODEL_HAS_ROLES = "model_has_roles";
    case MODEL_HAS_PERMISSIONS = "model_has_permissions";
    case PERSONAL_ACCESS_TOKEN = "personal_access_tokens";
    case PASSWORD_RESETS = "password_resets";
    case FAILED_JOBS = "failed_jobs";
    case JOBS = "jobs";

}
