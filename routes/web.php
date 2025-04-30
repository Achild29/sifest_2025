<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Livewire\Admin\ManageAdmin\ManageAdmin;
use App\Livewire\Admin\ManageKelas\ManageKelas as AdminManageKelas;
use App\Livewire\Admin\ManageKelas\ManageKelasAddTeacher;
use App\Livewire\Admin\ManageStudents\ManageStudents;
use App\Livewire\Admin\ManageTeacher\ManageTeacher;
use App\Livewire\Settings;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/login',[AuthController::class, 'index'])
        ->name('login');
        
    Route::post('/login', [AuthController::class, 'verify'])
        ->name('auth.verify');
    
});

Route::group(['middleware' =>'auth:admin'], function () {
    Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

    Route::prefix('admin')->group(function () {
       Route::get('/manage-students', ManageStudents::class)
       ->name('manage.students'); 

       Route::get('/manage-teachers', ManageTeacher::class)
       ->name('manage.teachers');

       Route::get('/manage-users', ManageAdmin::class)
       ->name('manage.users');
       
       Route::get('/manage-kelas', AdminManageKelas::class)
       ->name('admin.manage.kelas');

       Route::get('/manage-kelas/{id}/add', ManageKelasAddTeacher::class)
       ->name('admin.add.teacher.kelas');
    });
});

//Guru
require __DIR__.'/guru.php';

Route::group(['middleware' =>'auth:siswa'], function () {
    Route::get('/siswa', [StudentDashboardController::class, 'index'])
    ->name('siswa.dashboard');
});


Route::middleware('auth:admin,guru,siswa')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    
    Route::get('/settings', Settings::class)->name('settings');
});
