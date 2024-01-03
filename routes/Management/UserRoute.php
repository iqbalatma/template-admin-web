<?php

use App\Enums\Permission;
use Illuminate\Support\Facades\Route;

Route::prefix("users")->name("users.")->controller(\App\Http\Controllers\Management\UserController::class)->group(function (){
    Route::get("/", "index")->name("index")->middleware("permission:".Permission::USERS_INDEX());
    Route::get("/{id}", "edit")->name("edit")->middleware("permission:".Permission::USERS_EDIT());
    Route::put("/{id}", "update")->name("update")->middleware("permission:".Permission::USERS_UPDATE());
});
