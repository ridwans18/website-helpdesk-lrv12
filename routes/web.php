<?php

use App\Http\Controllers\Admin\berandaController;
use App\Http\Controllers\Admin\TambahTeknisiController;
use App\Http\Controllers\DaftarKeluhanController;
use Illuminate\Support\Facades\Route;

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
Route::get('/daftarkeluhan', [DaftarKeluhanController::class, 'index'])->name('admin.daftarKeluhan');


// Menghapus keluhan berdasarkan ID
Route::delete('/daftarkeluhan/{id}', [DaftarKeluhanController::class, 'destroy'])->name('admin.daftarKeluhan.destroy');


Route::post('/admin/tambah-teknisi', [TambahTeknisiController::class, 'store'])->name('admin.TambahTeknisi.store');



