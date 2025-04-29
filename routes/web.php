<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SectionInstallmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSectionController;
use App\Http\Controllers\SystemVariableController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
});

Route::controller(PermissionController::class)->group(function () {
    Route::get('permissions', 'index')->name('permissions.index')->can('view-permissions');
    Route::get('permissions/create', 'create')->name('permissions.create')->can('add-permission');
    Route::post('permissions', 'store')->name('permissions.store')->can('add-permission');
    Route::get('permissions/{permission}/edit', 'edit')->name('permissions.edit')->can('edit-permission');
    Route::put('permissions/{permission}', 'update')->name('permissions.update')->can('update-permission');
    Route::delete('permissions/{permission}', 'destroy')->name('permissions.destroy')->can('delete-permission');
});

Route::controller(RoleController::class)->group(function () {
    Route::get('roles', 'index')->name('roles.index')->can('view-roles');
    Route::get('roles/create', 'create')->name('roles.create')->can('add-role');
    Route::post('roles', 'store')->name('roles.store')->can('add-role');
    Route::get('roles/{role}', 'show')->name('roles.show')->can('view-role-details');
    Route::get('roles/{role}/edit', 'edit')->name('roles.edit')->can('edit-role');
    Route::put('roles/{role}', 'update')->name('roles.update')->can('update-role');
    Route::delete('roles/{role}', 'destroy')->name('roles.destroy')->can('delete-role');
});

Route::controller(UserController::class)->group(function () {
    Route::get('users', 'index')->name('users.index')->can('view-users');
    Route::get('users/create', 'create')->name('users.create')->can('add-user');
    Route::post('users/create', 'store')->name('users.store')->can('add-user');
    Route::get('users/{user}', 'show')->name('users.show')->can('view-user-details');
    Route::get('users/{user}/edit', 'edit')->name('users.edit')->can('edit-user');
    Route::put('users/{user}/edit', 'update')->name('users.update')->can('update-user');
    Route::delete('users/{user}/delete', 'destroy')->name('users.destroy')->can('delete-user');
    Route::get('profile', 'profile')->name('users.profile');
});

Route::controller(SystemVariableController::class)->group(function () {
    Route::get('variables', 'index')->name('variables.index')->can('view-variables');
    Route::get('variables/create', 'create')->name('variables.create')->can('add-variable');
    Route::post('variables', 'store')->name('variables.store')->can('add-variable');
    Route::get('variables/{systemVariable}/edit', 'edit')->name('variables.edit')->can('edit-variable');
    Route::put('variables/{systemVariable}', 'update')->name('variables.update')->can('update-variable');
    Route::delete('variables/{systemVariable}', 'destroy')->name('variables.destroy')->can('delete-variable');
    Route::get('variables/{systemVariable}/show', 'show')->name('variables.show')->can('view-variable-details');
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

Route::controller(FacultyController::class)->group(function () {
    Route::get('faculties', 'index')->name('faculties.index')->can('view-faculties');
    Route::get('faculties/create', 'create')->name('faculties.create')->can('add-faculty');
    Route::post('faculties', 'store')->name('faculties.store')->can('add-faculty');
    Route::get('faculties/{faculty}', 'show')->name('faculties.show')->can('view-faculty-details');
    Route::get('faculties/{faculty}/edit', 'edit')->name('faculties.edit')->can('edit-faculty');
    Route::put('faculties/{faculty}', 'update')->name('faculties.update')->can('update-faculty');
    Route::delete('faculties/{faculty}', 'destroy')->name('faculties.destroy')->can('delete-faculty');
});


Route::controller(CourseController::class)->group(function () {
    Route::get('courses', 'index')->name('courses.index');
    Route::get('courses/create', 'create')->name('courses.create');
    Route::post('courses', 'store')->name('courses.store');
    Route::get('courses/{course}', 'show')->name('courses.show');
    Route::get('courses/{course}/edit', 'edit')->name('courses.edit');
    Route::put('courses/{course}', 'update')->name('courses.update');
    Route::delete('courses/{course}', 'destroy')->name('courses.destroy');
});

Route::controller(SectionController::class)->group(function () {
    Route::get('sections', 'index')->name('sections.index');
    Route::get('sections/create', 'create')->name('sections.create');
    Route::post('sections', 'store')->name('sections.store');
    Route::get('sections/{section}', 'show')->name('sections.show');
    Route::get('sections/{section}/edit', 'edit')->name('sections.edit');
    Route::put('sections/{section}', 'update')->name('sections.update');
    Route::delete('sections/{section}', 'destroy')->name('sections.destroy');
});

Route::prefix('sections/{section}')->group(function(){
    Route::controller(SectionInstallmentController::class)->group(function(){
        Route::post('installments/create','store')->name('installments.create')->can('add-installment');
        Route::get('installments/{installment}/edit','edit')->name('installments.edit')->can('edit-installment');
        Route::put('installments/{installment}','update')->name('installments.update')->can('update-installment');
        Route::delete('installment/{installment}','destroy')->name('installments.destroy')->can('delete-installment');
    });
});

Route::controller(StudentController::class)->group(function () {
    Route::get('students', 'index')->name('students.index');
    Route::get('students/create', 'create')->name('students.create');
    Route::post('students', 'store')->name('students.store');
    Route::get('students/{student}', 'show')->name('students.show');
    Route::get('students/{student}/edit', 'edit')->name('students.edit');
    Route::put('students/{student}', 'update')->name('students.update');
    Route::delete('students/{student}', 'destroy')->name('students.destroy');
});

Route::get('/generate-permissions', function () {
    $permissions = [
        'view-dashboard',
        'view-students',
        'view-faculties',
        'view-courses',
        'view-sections',
        'view-users',
        'view-settings',
        'view-roles',
        'view-permissions',
        'view-variables',
        'add-student',
        'edit-student',
        'update-student',
        'delete-student',
        'view-student-details',
        'add-course',
        'edit-course',
        'update-course',
        'delete-course',
        'view-course-details',
        'add-section',
        'edit-section',
        'update-section',
        'delete-section',
        'view-section-details',
        'add-faculty',
        'edit-faculty',
        'update-faculty',
        'delete-faculty',
        'view-faculty-details',
        'add-user',
        'edit-user',
        'update-user',
        'delete-user',
        'view-user-details',
        'add-role',
        'edit-role',
        'update-role',
        'delete-role',
        'view-role-details',
        'add-permission',
        'edit-permission',
        'update-permission',
        'delete-permisison',
        'add-variable',
        'edit-variable',
        'update-variable',
        'delete-variable',
        'view-variable-details',
        'view-installments',
        'add-installment',
        'edit-installment',
        'update-installment',
        'delete-installment'
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }
    $superadminRole = Role::firstOrCreate(['name' => 'Superadmin']);

    $superadminRole->syncPermissions($permissions);
    return 'Permissions generated and assigned to Superadmin successfully!';
});