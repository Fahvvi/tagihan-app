<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Halaman Utama (Redirect ke login saja untuk saat ini)
Route::get('/', function () {
    return redirect('/login');
});

// --- RUTE AUTHENTICATION ---
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTE ADMIN (Diproteksi Middleware Admin) ---
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('admin.dashboard');
    // Nanti rute CRUD penggunaan, tarif, dll masuk sini

    // Resource Route untuk Tarif dan Pelanggan
    Route::resource('tarif', \App\Http\Controllers\TarifController::class);
    Route::resource('pelanggan', \App\Http\Controllers\PelangganController::class);
    
    // Route Penggunaan (Catat Meter)
    Route::resource('penggunaan', \App\Http\Controllers\PenggunaanController::class);
    // Route Tagihan & Pembayaran
    Route::get('/tagihan', [\App\Http\Controllers\TagihanController::class, 'index'])->name('tagihan.index');
    Route::post('/tagihan/{id}/bayar', [\App\Http\Controllers\TagihanController::class, 'bayar'])->name('tagihan.bayar');
    
    // Route Profil Admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    });

// --- RUTE PELANGGAN (Diproteksi Middleware Pelanggan) ---
Route::prefix('pelanggan')->middleware('auth:pelanggan')->group(function () {
    // Dashboard Utama
    Route::get('/dashboard', [\App\Http\Controllers\ClientAreaController::class, 'dashboard'])->name('pelanggan.dashboard');
    
    // Menu Tagihan
    Route::get('/tagihan', [\App\Http\Controllers\ClientAreaController::class, 'tagihan'])->name('pelanggan.tagihan');
    
    // Menu Profil Pelanggan
    Route::get('/profile', [ProfileController::class, 'edit'])->name('pelanggan.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('pelanggan.profile.update');
    
    // Proses Pembayaran (Mockup)
    Route::get('/bayar/{id}', [\App\Http\Controllers\ClientAreaController::class, 'showPayment'])->name('pelanggan.bayar');
    Route::post('/bayar/{id}', [\App\Http\Controllers\ClientAreaController::class, 'processPayment'])->name('pelanggan.process');
});