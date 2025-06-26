<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\TambahTeknisiController;
use App\Http\Controllers\TambahJabatanController;
use App\Http\Controllers\TambahKategoriController;
use App\Http\Controllers\TambahSatuanKerjaController;
use App\Http\Controllers\TambahLantaiController;
use App\Http\Controllers\DaftarKeluhanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


// Halaman utama (dashboard)
Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');


// User login (auth)
Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');
    Route::resource('beranda', BerandaController::class)->only(['create', 'store']);
    Route::post('/jabatan', [TambahJabatanController::class, 'store'])->name('TambahJabatan.store');
    Route::post('/kategori', [TambahKategoriController::class, 'store'])->name('TambahKategori.store');
    Route::post('/satuan-kerja', [TambahSatuanKerjaController::class, 'store'])->name('TambahSatuanKerja.store');
    Route::post('/lantai', [TambahLantaiController::class, 'store'])->name('TambahLantai.store');
});

// Login untuk guest saja
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register hanya untuk admin (level 1)
Route::middleware(['auth', 'level1'])->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::get('/user/{id}/edit', [AuthController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [AuthController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [AuthController::class, 'destroy'])->name('user.destroy');
});

Route::post('/register', [AuthController::class, 'register'])->name('register.store');


Route::get('/TambahTeknisi', [TambahTeknisiController::class, 'create'])->name('TambahTeknisi.create');


Route::post('/TambahTeknisi', [TambahTeknisiController::class, 'store'])->name('TambahTeknisi.store');


Route::post('/ubah-status/{id}', [berandaController::class, 'ubahStatus'])->name('ubahStatus');


Route::post('/tambah-teknisi', [TambahTeknisiController::class, 'store'])->name('TambahTeknisi.store');

Route::middleware(['auth'])->group(function () {
    
    // Daftar Keluhan (semua level user bisa akses)
    Route::resource('daftarkeluhan', DaftarKeluhanController::class);

    Route::get('/daftar-keluhan', [DaftarKeluhanController::class, 'indexBerlangsung'])->name('daftarKeluhan');

    // Tombol batal pada halaman editkeluhan
    Route::get('/editkeluhan', [DaftarKeluhanController::class, 'indexBerlangsung'])->name('daftarKeluhan');

    // Menampilkan daftar keluhan berlangsung
    Route::get('/daftarkeluhan', [DaftarKeluhanController::class, 'indexBerlangsung'])->name('daftarKeluhan');

    // Menampilkan daftar keluhan selesai
    Route::get('/keluhanselesai', [DaftarKeluhanController::class, 'indexSelesai'])->name('keluhanselesai');

    // Menghapus keluhan berdasarkan ID
    Route::delete('/daftar-keluhan/{id}', [DaftarKeluhanController::class, 'destroy'])->name('daftarKeluhan.destroy');

    // Edit & update keluhan (dari halaman beranda)
    Route::get('/keluhan/{id}/edit', [BerandaController::class, 'edit'])->name('keluhan.edit');
    Route::put('/keluhan/{id}', [BerandaController::class, 'update'])->name('keluhan.update');

    Route::get('/keluhan/berlangsung', [DaftarKeluhanController::class, 'indexBerlangsung'])->name('keluhan.berlangsung');
    Route::get('/keluhan/selesai', [DaftarKeluhanController::class, 'indexSelesai'])->name('keluhan.selesai');

    // Halaman laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/tampilkan', [LaporanController::class, 'tampilkan'])->name('laporan.tampilkan');
    Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
});
