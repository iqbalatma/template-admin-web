<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegistrationController;

Route::group([
    "controller" => AuthController::class,
    "as" => "auth."
], function () {
    Route::get("/login", 'login')->name('login');
    Route::post("/authenticate", 'authenticate')->name('authenticate');
    Route::post("/logout", 'logout')->name('logout');
});

Route::group([
    "controller" => ForgotPasswordController::class,
    "as" => "forgot.password."
], function () {
    Route::get("/forgot-password", 'index')->name('index');
    Route::post("/request-reset-token", 'requestToken')->name('request.token');
    Route::get("/reset-password/{email}/{token}", 'showResetPassword')->name('show.reset.password');
    Route::post("/reset-password", 'resetPassword')->name('reset');
});

Route::group([
    "controller" => RegistrationController::class,
    "as" => "registration.",
    "prefix" => "/registration"
], function () {
    Route::get("/", "create")->name("create");
    Route::post("/", "store")->name("store");
});
