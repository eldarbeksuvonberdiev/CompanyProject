<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::prefix('hr')->name('hr.')->group(function () {
    Route::resource('role', RoleController::class);
});
