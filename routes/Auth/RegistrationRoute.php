<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix("registration")->name("registration.")->controller(RegistrationController::class)->group(function (){
    Route::get("/", "create")->name("create");
    Route::post("/", "store")->name("store");
});
