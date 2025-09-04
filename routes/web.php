<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\ForgetController as AdminForgetController;

Route::fallback(function () {
    return redirect(route('admin.dashboard'));
});


Route::group(['prefix' => 'admin', 'middleware' => ['guest:admin']], function () {
    Route::get('/', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'authenticate'])->name('admin.login.submit')->withoutMiddleware('Demo');
});
