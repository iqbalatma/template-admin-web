<?php
use Illuminate\Support\Facades\Route;

Route::prefix("profiles")->name("profiles.")->controller(\App\Http\Controllers\Management\ProfileController::class)->group(function (){
    Route::get("", "edit")->name("edit");
    Route::patch("", "update")->name("update");
});
