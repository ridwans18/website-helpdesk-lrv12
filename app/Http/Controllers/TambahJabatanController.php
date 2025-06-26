<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class TambahJabatanController extends Controller
{
    public function store(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('jabatan_id', []);

        if ($action === 'simpan') {
            if ($request->filled('nama_jabatan')) {
                Jabatan::create([
                    'nama_jabatan' => $request->nama_jabatan
                ]);
                return back()->with('success', 'Lantai berhasil ditambahkan.');
            } else {
                return back()->with('error', 'Nama Lantai tidak boleh kosong.');
            }
        }

        if ($action === 'hapus') {
            if (!empty($ids)) {
                Jabatan::destroy($ids);
                return back()->with('success', 'Lantai yang dipilih berhasil dihapus.');
            } else {
                return back()->with('error', 'Tidak ada Lantai yang dipilih untuk dihapus.');
            }
        }

        return back()->with('error', 'Aksi tidak dikenali.');
    }
}
