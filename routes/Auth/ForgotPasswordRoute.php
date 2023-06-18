<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::name("forgot.password.")->controller(ForgotPasswordController::class)->group(function (){
    Route::get("/forgot-password", 'index')->name('index');
    Route::post("/request-reset-token", 'requestToken')->name('request.token');
    Route::get("/reset-password/{email}/{token}", 'showResetPassword')->name('show.reset.password');
    Route::post("/reset-password", 'resetPassword')->name('reset');
});
