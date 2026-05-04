<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrashController;

// Halaman Dashboard Utama
Route::get('/', [TrashController::class, 'index'])->name('dashboard');

// Halaman Network Nodes (Detail Sensor)
Route::get('/nodes', [TrashController::class, 'nodes'])->name('nodes');

// Halaman Analytics (Statistik)
Route::get('/analytics', [TrashController::class, 'analytics'])->name('analytics');
// Halaman Form Tambah Data
Route::get('/add-node', [TrashController::class, 'create'])->name('trash.create');

// Proses Simpan Data ke Database
Route::post('/store-node', [TrashController::class, 'store'])->name('trash.store');