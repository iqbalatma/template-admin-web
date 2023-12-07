<?php

use App\Enums\PermissionEnum;
use Illuminate\Support\Facades\Route;

Route::prefix("roles")->name("roles.")->controller(\App\Http\Controllers\Management\RoleController::class)->group(function (){
    Route::get("/", "index")->name("index")->middleware("permission:".PermissionEnum::ROLES_INDEX->value);
    Route::get("/{id}", "edit")->name("edit")->middleware("permission:".PermissionEnum::ROLES_UPDATE->value);
    Route::put("/{id}", "update")->name("update")->middleware("permission:".PermissionEnum::ROLES_UPDATE->value);;
});
