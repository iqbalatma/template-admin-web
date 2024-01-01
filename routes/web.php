<?php

use App\Enums\PermissionEnum;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Management\Master\PermissionController;
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


Route::group([], __DIR__ . "/Auth/AuthRoute.php");
Route::group([], __DIR__ . "/Auth/ForgotPasswordRoute.php");
Route::group([], __DIR__ . "/Auth/RegistrationRoute.php");

Route::middleware("auth")->group(function () {
    Route::prefix("management")->name("management.")->group(function () {
        Route::prefix("master")->name("master.")->group(function (){
            Route::get("/permissions", PermissionController::class)->name("permissions.index")->middleware("permission:" . PermissionEnum::PERMISSIONS_INDEX->value);
        });
        Route::group([], __DIR__ . "/Management/RoleRoute.php");
        Route::group([], __DIR__ . "/Management/UserRoute.php");
        Route::group([], __DIR__ . "/Management/ProfileRoute.php");
    });

    Route::get("images/{path}", \App\Http\Controllers\ImageController::class)->name("images");
    Route::get("/dashboard", DashboardController::class)->name("dashboard.index");
});
