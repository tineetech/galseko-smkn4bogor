<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\VerifikasiGaleryController;

// public route
Route::get('/', [HomeController::class, 'index']);
Route::get('/upload', [HomeController::class, 'upload']);
Route::post('/upload-galeri', [HomeController::class, 'uploadGaleri']);

// auth route
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'postLogin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// admin/private route
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/galery', GaleryController::class);
Route::resource('/verifikasi-galery', VerifikasiGaleryController::class);
Route::post('verifikasi-galery/{id}/verifikasi', [VerifikasiGaleryController::class, 'verifikasi'])
        ->name('verifikasi-galery.verifikasi');

Route::post('verifikasi-galery/{id}/tolak', [VerifikasiGaleryController::class, 'tolak'])
        ->name('verifikasi-galery.tolak');
Route::resource('/pengaturan', PengaturanController::class);
Route::post('/pengaturan-akun', [PengaturanController::class, 'update'])->name('pengaturan-akun.update');

