<?php

use App\Http\Controllers\Teacher\DashboardController;
use App\Livewire\Guru\Absensi\Absensi;
use App\Livewire\Guru\Absensi\AbsensiKelas;
use App\Livewire\Guru\Absensi\AbsensiKelasManual;
use App\Livewire\Guru\Absensi\ScanMasuk;
use App\Livewire\Guru\Absensi\ScanPulang;
use App\Livewire\Guru\BahanAjar\BahanAjar;
use App\Livewire\Guru\BahanAjar\ChatBot;
use App\Livewire\Guru\ManageKelas\ManageKelas;
use App\Livewire\Guru\ManageKelas\ManageKelasAddStudents;
use App\Livewire\Guru\ManageKelas\ManageKelasDetail;
use App\Livewire\Guru\Report\Report;
use App\Livewire\Guru\Report\ReportKelas;
use App\Livewire\Guru\Report\ReportSiswa;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' =>'auth:guru'], function () {
    Route::get('/guru', [DashboardController::class, 'index'])
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

        Route::prefix('/absensi')->group(function () {
            Route::get('/', Absensi::class)
            ->name('guru.absensi');
    
            Route::prefix('/{id}')->group(function () {
                Route::get('/', AbsensiKelas::class)
                ->name('guru.absensi.kelas');
        
                Route::get('/add-manual', AbsensiKelasManual::class)
                ->name('guru.absensi.kelas.manual');
        
                Route::get('/scan-masuk', ScanMasuk::class)
                ->name('guru.absensi.scan.masuk');
        
                Route::get('/scan-pulang', ScanPulang::class)
                ->name('guru.absensi.scan.pulang');
            });
        });
    
        Route::prefix('/report')->group(function () {
            Route::get('/', Report::class)
            ->name('guru.laporan');
            
            Route::get('/kelas-{id}', ReportKelas::class)
            ->name('guru.laporan.kelas');
    
            Route::get('/siswa-{id}', ReportSiswa::class)
            ->name('guru.laporan.siswa');
        });

        Route::prefix('/bahan-ajar')->group(function () {
            Route::get('/', BahanAjar::class)
            ->name('bahan.ajar');

            Route::get('/chat', ChatBot::class)
            ->name('chatbot');
        });

    });

    
});