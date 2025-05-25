<?php

use App\Http\Controllers\berandaController;
use App\Http\Controllers\TambahTeknisiController;
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


Route::get('/beranda', [berandaController::class, 'index'])->name('beranda');


Route::resource('beranda', BerandaController::class)->only(['create', 'store']);


Route::resource('daftarkeluhan', BerandaController::class);

/*Route::get('/admin/daftarkeluhan/{id}/edit', [berandaController::class, 'edit'])
     ->name('admin.daftarkeluhan.edit');*/


// button batal pada halaman editkeluhan
Route::get('/editkeluhan', [DaftarKeluhanController::class, 'index'])->name('daftarKeluhan');


Route::get('/keluhan/{id}/edit', [berandaController::class, 'edit'])->name('keluhan.edit');


Route::put('/keluhan/{id}', [berandaController::class, 'update'])->name('keluhan.update');


Route::get('/TambahTeknisi', [TambahTeknisiController::class, 'create'])->name('TambahTeknisi.create');


Route::post('/TambahTeknisi', [TambahTeknisiController::class, 'store'])->name('TambahTeknisi.store');


/*Route::get('daftarkeluhan', function () {
    return view('daftarkeluhan');
});*/


// Menampilkan daftar keluhan
Route::get('/daftarkeluhan', action: [DaftarKeluhanController::class, 'index'])->name('daftarKeluhan');


// Menghapus keluhan berdasarkan ID
Route::delete('/daftar-keluhan/{id}', [DaftarKeluhanController::class, 'destroy'])->name('daftarKeluhan.destroy');


Route::post('/ubah-status/{id}', [berandaController::class, 'ubahStatus'])->name('ubahStatus');


Route::post('/tambah-teknisi', [TambahTeknisiController::class, 'store'])->name('TambahTeknisi.store');


Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');


Route::get('/laporan/tampilkan', [LaporanController::class, 'tampilkan'])->name('laporan.tampilkan');


Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
