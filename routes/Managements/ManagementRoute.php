<?php

use App\Http\Controllers\Management\PermissionController;
use App\Http\Controllers\Management\RoleController;
use App\Http\Controllers\Management\UserController;

Route::get("/permissions", PermissionController::class)->name("permissions.index");
Route::group([
    "controller" => RoleController::class,
    "prefix" => "roles",
    "as" => "roles."
], function () {
    Route::get("/", "index")->name("index");
    Route::get("/{id}", "edit")->name("edit");
    Route::put("/{id}", "update")->name("update");
});
Route::group([
    "controller" => UserController::class,
    "prefix" => "users",
    "as" => "users."
], function () {
    Route::get("/", "index")->name("index");
    Route::get("/{id}", "edit")->name("edit");
    Route::put("/{id}", "update")->name("update");
});
