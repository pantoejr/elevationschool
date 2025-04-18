<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SystemVariableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('permissions', 'index')->name('permissions.index');
    Route::get('permissions/create', 'create')->name('permissions.create');
    Route::post('permissions', 'store')->name('permissions.store');
    Route::get('permissions/{permission}/edit', 'edit')->name('permissions.edit');
    Route::put('permissions/{permission}', 'update')->name('permissions.update');
    Route::delete('permissions/{permission}', 'destroy')->name('permissions.destroy');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('roles', 'index')->name('roles.index');
    Route::get('roles/create', 'create')->name('roles.create');
    Route::post('roles', 'store')->name('roles.store');
    Route::get('roles/{role}', 'show')->name('roles.show');
    Route::get('roles/{role}/edit', 'edit')->name('roles.edit');
    Route::put('roles/{role}', 'update')->name('roles.update');
    Route::delete('roles/{role}', 'destroy')->name('roles.destroy');
});

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('users.index');
    Route::get('users/create', 'create')->name('users.create');
    Route::post('users/create', 'store')->name('users.store');
    Route::get('users/{user}', 'show')->name('users.show');
    Route::get('users/{user}/edit', 'edit')->name('users.edit');
    Route::put('users/{user}/edit', 'update')->name('users.update');
    Route::delete('users/{user}/delete', 'destroy')->name('users.destroy');
    Route::get('profile', 'profile')->name('users.profile');
});

Route::controller(SystemVariableController::class)->group(function () {
    Route::get('variables', 'index')->name('variables.index');
    Route::get('variables/create', 'create')->name('variables.create');
    Route::post('variables', 'store')->name('variables.store');
    Route::get('variables/{systemVariable}/edit', 'edit')->name('variables.edit');
    Route::put('variables/{systemVariable}', 'update')->name('variables.update');
    Route::delete('variables/{systemVariable}', 'destroy')->name('variables.destroy');
    Route::get('variables/{systemVariable}/show', 'show')->name('variables.show');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login', 'authenticate')->name('auth.login');
    Route::get('logout', 'logout')->name('auth.logout');
    Route::get('change-password', 'showChangePasswordForm')->name('change-password');
    Route::post('change-password', 'changePassword')->name('confirm-change-password');
    Route::get('password/reset', 'showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'showResetForm')->name('password.reset');
    Route::post('password/reset', 'reset')->name('password.update');
});
