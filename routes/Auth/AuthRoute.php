<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;


Route::name("auth.")->controller(AuthController::class)->group(function (){
    Route::get("/login", 'login')->name('login');
    Route::post("/authenticate", 'authenticate')->name('authenticate');
    Route::post("/logout", 'logout')->name('logout');
});
