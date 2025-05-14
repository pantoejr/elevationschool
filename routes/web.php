<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstallmentController;
use App\Http\Controllers\PaymentController;
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

Route::controller(PaymentController::class)->group(function () {
    Route::get('payments','index')->name('payments.index');
    Route::get('payments/create','create')->name('payments.create');
    Route::post('payments/store','store')->name('payments.store');
    Route::get('payments/get_student','getStudent')->name('payments.getStudent');
    Route::get('payments/{payment}/edit', 'edit')->name('payments.edit');
    Route::delete('payments/{payment}', 'destroy')->name('payments.destroy');
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

Route::prefix('sections/{section}')->group(function () {
    Route::controller(SectionInstallmentController::class)->group(function () {
        Route::post('installments/create', 'store')->name('sectionInstallment.create')->can('add-installment');
        Route::get('installments/{installment}/edit', 'edit')->name('sectionInstallment.edit')->can('edit-installment');
        Route::put('installments/{installment}', 'update')->name('sectionInstallment.update')->can('update-installment');
        Route::delete('installment/{installment}', 'destroy')->name('sectionInstallment.destroy')->can('delete-installment');
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
    Route::post('students/{student}/attachments/store','storeStudentAttachment')->name('storeStudentAttachment');
    Route::get('students/attachment/{attachment}','showStudentAttachment')->name('showStudentAttachment');
    Route::post('students/{student}/attachment/{attachment}','destroyStudentAttachment')->name('deleteStudentAttachment');
});

Route::prefix('students/{student}')->group(function () {
    Route::controller(StudentSectionController::class)->group(function () {
        Route::post('sections', 'store')->name('studentSections.store')->can('add-student-section');
        Route::get('sections/{section}/edit', 'edit')->name('studentSections.edit')->can('edit-student-section');
        Route::put('sections/{section}', 'update')->name('studentSections.update')->can('update-student-section');
        Route::delete('sections/{section}', 'destroy')->name('studentSections.destroy')->can('delete-student-section');
    });
});

Route::controller(InstallmentController::class)->group(function () {
    Route::get('installments', 'index')->name('installments.index')->can('view-installments');
    Route::get('installments/create', 'create')->name('installments.create')->can('add-installment');
    Route::post('installments', 'store')->name('installments.store')->can('add-installment');
    Route::get('installments/{installment}', 'show')->name('installments.show')->can('view-installment-details');
    Route::get('installments/{installment}/edit', 'edit')->name('installments.edit')->can('edit-installment');
    Route::put('installments/{installment}', 'update')->name('installments.update')->can('update-installment');
    Route::delete('installments/{installment}', 'destroy')->name('installments.destroy')->can('delete-installment');
});

Route::controller(AttendanceController::class)->group(function(){
    Route::get('attendances', 'index')->name('attendances.index')->can('view-attendances');
    Route::get('attendances/create', 'create')->name('attendances.create')->can('add-attendance');
    Route::post('attendances', 'store')->name('attendances.store')->can('add-attendance');
    Route::get('attendances/{attendance}', 'show')->name('attendances.show')->can('view-attendance-details');
    Route::get('attendances/{attendance}/edit', 'edit')->name('attendances.edit')->can('edit-attendance');
    Route::put('attendances/{attendance}', 'update')->name('attendances.update')->can('update-attendance');
    Route::delete('attendances/{attendance}', 'destroy')->name('attendances.destroy')->can('delete-attendance');
});

Route::get('/generate-permissions', function () {
    $permissions = [
        'view-dashboard',
        'view-faculties',
        'view-courses',
        'view-sections',
        'view-users',
        'view-settings',
        'view-roles',
        'view-permissions',
        'view-variables',
        'view-students',
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
        'view-installment-details',
        'add-installment',
        'edit-installment',
        'update-installment',
        'delete-installment',
        'view-student-sections',
        'add-student-section',
        'edit-student-section',
        'update-student-section',
        'delete-student-section',
        'add-student-attachment',
        'view-student-attachment',
        'delete-student-attachment',
        'download-student-attachment',
        'view-attendances',
        'add-attendance',
        'edit-attendance',
        'update-attendance',
        'delete-attendance',
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }
    $superadminRole = Role::firstOrCreate(['name' => 'Superadmin']);

    $superadminRole->syncPermissions($permissions);
    return 'Permissions generated and assigned to Superadmin successfully!';
});
