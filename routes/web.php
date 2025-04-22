<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Livewire\Admin\ListUser;
use App\Livewire\Admin\ManageStudent;
use App\Livewire\Admin\ManageTeacher;
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
       Route::get('/manage-students', ManageStudent::class)
       ->name('manage.students'); 

       Route::get('/manage-teachers', ManageTeacher::class)
       ->name('manage.teachers');

       Route::get('/list-users', ListUser::class)
       ->name('list.users');
    });
});

Route::group(['middleware' =>'auth:guru'], function () {
    Route::get('/guru', [TeacherDashboardController::class, 'index'])
    ->name('guru.dashboard');

    Route::prefix('/guru')->group(function () {
       
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
