<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\pdf\JadwalPdf;
use App\Http\Controllers\pdf\PdfLayout;
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

//Admin
require __DIR__.'/admin.php';

//Guru
require __DIR__.'/guru.php';

//Siswa
require __DIR__.'/siswa.php';

Route::post('/view-pdf', [PdfLayout::class, 'viewPdf'])->name('view-pdf');
Route::post('/download-pdf', [PdfLayout::class, 'downloadPdf'])->name('download-pdf');
Route::post('/download-pdf-landscape', [PdfLayout::class, 'downloadPdfLandscape'])->name('download-pdf-landscape');

Route::post('/download-pdf-jadwal', [JadwalPdf::class, 'pdfDownload'])->name('jadwal.pdf');

Route::middleware('auth:admin,guru,siswa')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])
        ->name('logout');
    
    Route::get('/settings', Settings::class)->name('settings');
});
