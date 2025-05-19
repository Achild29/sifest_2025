<?php

use App\Http\Controllers\Student\DashboardController;
use App\Livewire\Siswa\Jadwal\Jadwal;
use App\Livewire\Siswa\Materi\Materi;
use App\Livewire\Siswa\Qr\QrCode;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' =>'auth:siswa'], function () {
    Route::prefix('/siswa')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])
        ->name('siswa.dashboard');

        Route::get('/qrcode', QrCode::class)
            ->name('qrcode');

        Route::get('/modul', Materi::class)
            ->name('modul');
        
        Route::get('/jadwal', Jadwal::class)
            ->name('jadwal.siswa');
    });



});