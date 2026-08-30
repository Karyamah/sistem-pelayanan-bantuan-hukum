<?php

use App\Http\Controllers\PengaduController;
use App\Http\Controllers\NotulensiController;
use App\Http\Controllers\DokumentasiKegiatanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {

    // Admin & Petugas: kelola data operasional
    Route::middleware(['role:admin,petugas'])->group(function () {
        Route::resource('pengadu', PengaduController::class);
        Route::resource('notulensi', NotulensiController::class);
        Route::resource('dokumentasi', DokumentasiKegiatanController::class);
    });

    // Admin, Petugas, Pimpinan: bisa lihat laporan
    Route::middleware(['role:admin,petugas,pimpinan'])->group(function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.pdf');
    });

    // Khusus Admin: kelola user
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('user', UserController::class)->except(['show']);
    });

});

require __DIR__.'/auth.php';