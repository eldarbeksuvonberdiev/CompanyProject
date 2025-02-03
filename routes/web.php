<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main.main');
})->name('main');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('/user', UserController::class);
    Route::get('/user/{user}/status/edit', [UserController::class, 'status'])->name('user.status.update');

    Route::resource('/role', RoleController::class);
    Route::get('/role/{role}/status/edit', [RoleController::class, 'status'])->name('role.status.update');

    Route::get('/permission-group', [PermissionGroupController::class, 'index'])->name('permission.index');
    Route::get('/permission-group/{permissionGroup}/edit', [PermissionGroupController::class, 'edit'])->name('permission.edit');
});

Route::prefix('hr')->name('hr.')->group(function () {
    Route::resource('/employee', EmployeeController::class);
});
