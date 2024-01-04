<?php

use App\Enums\Permission;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Management\Master\PermissionController;
use App\Http\Controllers\Management\Master\RoleController;
use App\Http\Controllers\Management\ProfileController;
use App\Http\Controllers\Management\UserController;
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
            Route::get("/permissions", PermissionController::class)->name("permissions.index")->middleware("permission:" . Permission::PERMISSIONS_INDEX->value);
            Route::prefix("roles")->name("roles.")->controller(RoleController::class)->group(function (){
                Route::get("/", "index")->name("index")->middleware("permission:".Permission::ROLES_INDEX->value);
                Route::get("/create", "create")->name("create")->middleware("permission:".Permission::ROLES_STORE->value);
                Route::post("/", "store")->name("store")->middleware("permission:".Permission::ROLES_STORE->value);
                Route::get("/{id}", "edit")->name("edit")->middleware("permission:".Permission::ROLES_UPDATE->value);
                Route::put("/{id}", "update")->name("update")->middleware("permission:".Permission::ROLES_UPDATE->value);
            });
        });

        Route::prefix("users")->name("users.")->controller(UserController::class)->group(function (){
            Route::get("/", "index")->name("index")->middleware("permission:".Permission::USERS_INDEX->value);
            Route::get("/{id}", "edit")->name("edit")->middleware("permission:".Permission::USERS_EDIT->value);
            Route::put("/{id}", "update")->name("update")->middleware("permission:".Permission::USERS_UPDATE->value);
        });


        Route::prefix("profiles")->name("profiles.")->controller(ProfileController::class)->group(function (){
            Route::get("", "edit")->name("edit");
            Route::patch("", "update")->name("update");
        });
    });

    Route::get("images/{path}", \App\Http\Controllers\ImageController::class)->name("images");
    Route::get("/dashboard", DashboardController::class)->name("dashboard.index");
});
