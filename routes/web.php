<?php

use App\Http\Controllers\Admin\berandaController;
use App\Http\Controllers\Admin\TambahTeknisiController;
use App\Http\Controllers\DaftarKeluhanController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\LoginController;

// Route::get('/login', [LoginController::class, 'showForm'])->name('login');
// Route::post('/login', [LoginController::class, 'login'])->name('login.proses');
// Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// // Tambahkan proteksi halaman beranda
// Route::get('/beranda', function () {
//     if (!session()->has('user')) {
//         return redirect('/login');
//     }

//     // Kirim variabel user ke view
//     return view('beranda', ['user' => session('user')]);
// });

Route::get('/', function () {
    return view('welcome');
});


Route::get('beranda', function () {
    return view('beranda');
});


Route::get('/beranda', [berandaController::class, 'index'])->name('admin.beranda');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('beranda', berandaController::class)->only(['create', 'store']);
});


Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('daftarkeluhan', berandaController::class);
});


/*Route::get('/admin/daftarkeluhan/{id}/edit', [berandaController::class, 'edit'])
     ->name('admin.daftarkeluhan.edit');*/


// button batal pada halaman editkeluhan
Route::get('/editkeluhan', [DaftarKeluhanController::class, 'index'])->name('admin.daftarKeluhan');


Route::get('/keluhan/{id}/edit', [berandaController::class, 'edit'])->name('keluhan.edit');


Route::put('/keluhan/{id}', [berandaController::class, 'update'])->name('keluhan.update');


Route::get('/admin/TambahTeknisi', [TambahTeknisiController::class, 'create'])->name('admin.TambahTeknisi.create');


Route::post('/admin/TambahTeknisi', [TambahTeknisiController::class, 'store'])->name('admin.TambahTeknisi.store');


/*Route::get('daftarkeluhan', function () {
    return view('daftarkeluhan');
});*/


// Menampilkan daftar keluhan
Route::get('/daftarkeluhan', action: [DaftarKeluhanController::class, 'index'])->name('admin.daftarKeluhan');


// Menghapus keluhan berdasarkan ID
Route::delete('/daftarkeluhan/{id}', [DaftarKeluhanController::class, 'destroy'])->name('admin.daftarKeluhan.destroy');


Route::post('/ubah-status/{id}', [berandaController::class, 'ubahStatus'])->name('admin.ubahStatus');


Route::post('/admin/tambah-teknisi', [TambahTeknisiController::class, 'store'])->name('admin.TambahTeknisi.store');


Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');


Route::get('/laporan/tampilkan', [LaporanController::class, 'tampilkan'])->name('laporan.tampilkan');


Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
