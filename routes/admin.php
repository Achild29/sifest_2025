<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Livewire\Admin\ManageAdmin\ManageAdmin;
use App\Livewire\Admin\ManageAdmin\ManageAdminDashboard;
use App\Livewire\Admin\ManageKelas\ManageKelas;
use App\Livewire\Admin\ManageKelas\ManageKelasAddTeacher;
use App\Livewire\Admin\ManageStudents\ManageStudentsDashboard;
use App\Livewire\Admin\ManageTeacher\ManageTeacherDashboard;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' =>'auth:admin'], function () {
    Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

    Route::prefix('admin')->group(function () {
        Route::get('/manage-students', ManageStudentsDashboard::class)
            ->name('manage.students');

        Route::get('/manage-teachers', ManageTeacherDashboard::class)
            ->name('manage.teachers');

        Route::get('/manage-admin', ManageAdminDashboard::class)
            ->name('manage.admin');
       
       Route::get('/manage-kelas', ManageKelas::class)
       ->name('admin.manage.kelas');

       Route::get('/manage-kelas/{id}/add', ManageKelasAddTeacher::class)
       ->name('admin.add.teacher.kelas');
    });
});