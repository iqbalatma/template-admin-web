<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;


Route::name("auth.")->controller(AuthController::class)->group(function () {
    Route::get("/login", 'login')->name('login')->middleware("guest");
    Route::post("/authenticate", 'authenticate')->name('authenticate')->middleware("guest");
    Route::post("/logout", 'logout')->name('logout')->middleware("auth");
});
