<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::name("forgot.password.")->controller(ForgotPasswordController::class)->group(function () {
    Route::get("/forgot-password", 'showRequestForgotPassword')->name('show.request.forgot.password');
    Route::post("/request-reset-token", 'requestToken')->name('request.token');
    Route::get("/reset-password/{email}/{token}", 'showResetPassword')->name('show.reset.password');
    Route::post("/reset-password", 'resetPassword')->name('reset');
});
