<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Meta\Meta;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Values;
use App\Enums\MetaProperties\{Description, FeatureGroup};

#[Meta(Description::class, FeatureGroup::class)]
enum Permission: string
{
    use InvokableCases;
    use Values;
    use Metadata;

    #[Description("can show all data permissions")] #[FeatureGroup("permissions")]
    case PERMISSIONS_INDEX = "permissions.index";

    #[Description("can show all data roles")] #[FeatureGroup("roles")]
    case ROLES_INDEX = "roles.index";

    #[Description("can update data roles")] #[FeatureGroup("roles")]
    case ROLES_UPDATE = "roles.update";

    #[Description("can create data roles")] #[FeatureGroup("roles")]
    case ROLES_STORE = "roles.store";


    #[Description("can show all data user")] #[FeatureGroup("users")]
    case USERS_INDEX = "users.index";

    #[Description("can show form edit data user")] #[FeatureGroup("users")]
    case USERS_EDIT = "users.edit";

    #[Description("can update data user")] #[FeatureGroup("users")]
    case USERS_UPDATE = "users.update";
}
