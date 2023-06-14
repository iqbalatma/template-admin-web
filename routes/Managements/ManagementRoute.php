<?php

use App\Http\Controllers\Management\PermissionController;
use App\Http\Controllers\Management\RoleController;
use App\Http\Controllers\Management\UserController;
use Illuminate\Support\Facades\Route;


Route::get("/permissions", PermissionController::class)->name("permissions.index");
Route::prefix("roles")->name("roles.")->controller(RoleController::class)->group(function (){
    Route::get("/", "index")->name("index");
    Route::get("/{id}", "edit")->name("edit");
    Route::put("/{id}", "update")->name("update");
});

Route::prefix("users")->name("users.")->controller(UserController::class)->group(function (){
    Route::get("/", "index")->name("index");
    Route::get("/{id}", "edit")->name("edit");
    Route::put("/{id}", "update")->name("update");
});

Route::prefix("profiles")->name("profiles.")->controller(\App\Http\Controllers\Management\ProfileController::class)->group(function (){
    Route::get("", "edit")->name("edit");
    Route::post("", "update")->name("update");
});
