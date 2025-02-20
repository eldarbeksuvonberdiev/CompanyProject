<?php

use App\Http\Controllers\DeliveryNoteController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PermissionGroupController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\WarehouseMaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main.main');
})->name('main');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::resource('/user', UserController::class);
    Route::get('/user/{user}/status/edit', [UserController::class, 'status'])->name('user.status.update');

    Route::resource('/role', RoleController::class);
    Route::get('/role/{role}/status/edit', [RoleController::class, 'status'])->name('role.status.update');

    Route::get('/permission-group', [PermissionGroupController::class, 'index'])->name('permissionGroup.index');
    Route::get('/permission-group/{permissionGroup}/', [PermissionGroupController::class, 'permissions'])->name('permission.permissions');
    Route::get('/permission-group/{permissionGroup}/edit', [PermissionGroupController::class, 'edit'])->name('permissionGroup.edit');

    Route::put('/permission-edit/{permission}', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('/permission-edit/{permission}/status', [PermissionController::class, 'status'])->name('permission.status');
});

Route::prefix('hr')->name('hr.')->group(function () {
    Route::resource('/employee', EmployeeController::class);
    Route::resource('/salary', SalaryController::class);
    Route::resource('/warehouse', WarehouseController::class);
    Route::get('/warehouse-status/{warehouse}', [WarehouseController::class, 'status'])->name('warehouse.status');
    Route::get('/warehouse-products/{warehouse}', [WarehouseController::class, 'products'])->name('warehouse.products');
});

Route::prefix('warehouse')->name('warehouse.')->group(function () {
    Route::resource('/delivery-notes', DeliveryNoteController::class);
    Route::post('/warehouse-transfer/{material}', [WarehouseMaterialController::class, 'transfer'])->name('warehouseMaterial.transfer');
});

Route::prefix('production')->name('production.')->group(function () {
    Route::resource('product', ProductController::class);
    Route::resource('machine', MachineController::class);
});
