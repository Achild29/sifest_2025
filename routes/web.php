<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Livewire\Admin\ManageAdmin\ManageAdmin;
use App\Livewire\Admin\ManageKelas\ManageKelas as AdminManageKelas;
use App\Livewire\Admin\ManageKelas\ManageKelasAddTeacher;
use App\Livewire\Admin\ManageStudents\ManageStudents;
use App\Livewire\Admin\ManageTeacher\ManageTeacher;
use App\Livewire\Guru\Absensi\Absensi;
use App\Livewire\Guru\Absensi\AbsensiKelas;
use App\Livewire\Guru\Absensi\AbsensiKelasManual;
use App\Livewire\Guru\ManageKelas\ManageKelas;
use App\Livewire\Guru\ManageKelas\ManageKelasAddStudents;
use App\Livewire\Guru\ManageKelas\ManageKelasDetail;
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

Route::group(['middleware' =>'auth:guru'], function () {
    Route::get('/guru', [TeacherDashboardController::class, 'index'])
    ->name('guru.dashboard');

    Route::prefix('/guru')->group(function () {
        Route::prefix('/kelas')->group(function () { 
            Route::get('/', ManageKelas::class)
            ->name('manage.kelas');

            Route::get('/{id}', ManageKelasDetail::class)
            ->name('detail.kelas');

            Route::get('/{id}/add-students', ManageKelasAddStudents::class)
            ->name('add.students.kelas');
        });
    });

    Route::prefix('/absensi')->group(function () {
        Route::get('/', Absensi::class)
        ->name('guru.absensi');

        Route::get('/{id}', AbsensiKelas::class)
        ->name('guru.absensi.kelas');

        Route::get('/{id}/add-manual', AbsensiKelasManual::class)
        ->name('guru.absensi.kelas.manual');
        
    });
});

Route::group(['middleware' =>'auth:siswa'], function () {
    Route::get('/siswa', [StudentDashboardController::class, 'index'])
    ->name('siswa.dashboard');
});


Route::middleware('auth:admin,guru,siswa')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    
    Route::get('/settings', Settings::class)->name('settings');
});
