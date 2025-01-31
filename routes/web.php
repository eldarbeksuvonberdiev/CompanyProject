<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main.main');
})->name('main');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('/user', UserController::class);
    Route::resource('/role', RoleController::class);
    Route::get('/permission-group', [RoleController::class, 'index'])->name('permission.index');
});
