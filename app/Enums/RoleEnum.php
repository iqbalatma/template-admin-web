<?php

namespace App\Enums;

enum RoleEnum:string
{
    case SUPERADMIN = "superadmin";
    case ADMIN = "admin";
    case CUSTOMER = "customer";
    case TICKET_CHECKER = "tikcet-checker";
}
