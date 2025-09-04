<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SummernoteController;
use App\Http\Controllers\Admin\TenantController;
use Illuminate\Support\Facades\Route;


    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/change-theme', [DashboardController::class, 'changeTheme'])->name('admin.theme.change');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/edit/profile', [ProfileController::class, 'editProfile'])->name('admin.edit.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('admin.update.profile');
    Route::get('/changePassword', [ProfileController::class, 'changePass'])->name('admin.change.password');
    Route::post('/profile/updatePassword', [ProfileController::class, 'updatePassword'])->name('admin.update.password');


    Route::post('/summernote/upload', [SummernoteController::class, 'upload'])->name('admin.summernote.upload');


    Route::group(['middleware' => 'checkpermission:Role Management'], function () {

        Route::get('/roles', [RoleController::class, 'index'])->name('admin.role.index');
        Route::post('/role/store', [RoleController::class, 'store'])->name('admin.role.store');
        Route::post('/role/update', [RoleController::class, 'update'])->name('admin.role.update');
        Route::post('/role/delete', [RoleController::class, 'delete'])->name('admin.role.delete');
        Route::get('role/{id}/permissions/manage', [RoleController::class, 'managePermissions'])->name('admin.role.permissions.manage');
        Route::post('role/permissions/update', [RoleController::class, 'updatePermissions'])->name('admin.role.permissions.update');
    });

    Route::group(['middleware' => 'checkpermission:Admins Management'], function () {
        Route::get('/tenants', [TenantController::class, 'index'])->name('admin.tenant.index');
        Route::post('/tenant/store', [TenantController::class, 'store'])->name('admin.tenant.store');
        Route::get('/tenant/{id}/edit', [TenantController::class, 'edit'])->name('admin.tenant.edit');
        Route::post('/tenant/update', [TenantController::class, 'update'])->name('admin.tenant.update');
        Route::post('/tenant/delete', [TenantController::class, 'delete'])->name('admin.tenant.delete');
    });

