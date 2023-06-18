<?php
use Illuminate\Support\Facades\Route;

Route::prefix("roles")->name("roles.")->controller(\App\Http\Controllers\Management\RoleController::class)->group(function (){
    Route::get("/", "index")->name("index");
    Route::get("/{id}", "edit")->name("edit");
    Route::put("/{id}", "update")->name("update");
});
