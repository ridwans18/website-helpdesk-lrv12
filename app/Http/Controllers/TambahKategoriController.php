<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class TambahKategoriController extends Controller
{
    public function store(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('kategori_id', []);

        if ($action === 'simpan') {
            if ($request->filled('nama_kategori')) {
                Kategori::create([
                    'nama_kategori' => $request->nama_kategori
                ]);
                return back()->with('success', 'Lantai berhasil ditambahkan.');
            } else {
                return back()->with('error', 'Nama Lantai tidak boleh kosong.');
            }
        }

        if ($action === 'hapus') {
            if (!empty($ids)) {
                Kategori::destroy($ids);
                return back()->with('success', 'Lantai yang dipilih berhasil dihapus.');
            } else {
                return back()->with('error', 'Tidak ada Lantai yang dipilih untuk dihapus.');
            }
        }

        return back()->with('error', 'Aksi tidak dikenali.');
    }
}
