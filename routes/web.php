<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(
    [
        "controller" => AuthController::class,
        "as" => "auth."
    ],
    function () {
        Route::get("/login", 'login')->name('login');
        Route::post("/authenticate", 'authenticate')->name('authenticate');
        Route::post("/logout", 'logout')->name('logout');
    }
);

Route::group([
    "controller" => ForgotPasswordController::class,
    "as" => "forgot.password."
], function () {
    Route::get("/forgot-password", 'index')->name('index');
    Route::post("/request-reset-token", 'requestToken')->name('request.token');
    Route::get("/reset-password/{email}/{token}", 'showResetPassword')->name('show.reset.password');
    Route::post("/reset-password", 'resetPassword')->name('reset');
});


Route::get("/dashboard", DashboardController::class)->name("dashboard.index");
