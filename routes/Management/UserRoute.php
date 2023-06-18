<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Management\RoleController;

Route::prefix("users")->name("users.")->controller(\App\Http\Controllers\Management\UserController::class)->group(function (){
    Route::get("/", "index")->name("index");
    Route::get("/{id}", "edit")->name("edit");
    Route::put("/{id}", "update")->name("update");
});
