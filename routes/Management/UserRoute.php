<?php

use App\Enums\PermissionEnum;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->name("users.")->controller(\App\Http\Controllers\Management\UserController::class)->group(function (){
    Route::get("/", "index")->name("index")->middleware("permission:".PermissionEnum::USERS_INDEX());
    Route::get("/{id}", "edit")->name("edit")->middleware("permission:".PermissionEnum::USERS_EDIT());
    Route::put("/{id}", "update")->name("update")->middleware("permission:".PermissionEnum::USERS_UPDATE());
});
