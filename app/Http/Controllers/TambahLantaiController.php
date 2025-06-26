<?php

namespace App\Http\Controllers;

use App\Models\Lantai;
use Illuminate\Http\Request;

class TambahLantaiController extends Controller
{
    public function store(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('lantai_id', []);

        if ($action === 'simpan') {
            if ($request->filled('nama_lantai')) {
                Lantai::create([
                    'nama_lantai' => $request->nama_lantai
                ]);
                return back()->with('success', 'Lantai berhasil ditambahkan.');
            } else {
                return back()->with('error', 'Nama Lantai tidak boleh kosong.');
            }
        }

        if ($action === 'hapus') {
            if (!empty($ids)) {
                Lantai::destroy($ids);
                return back()->with('success', 'Lantai yang dipilih berhasil dihapus.');
            } else {
                return back()->with('error', 'Tidak ada Lantai yang dipilih untuk dihapus.');
            }
        }

        return back()->with('error', 'Aksi tidak dikenali.');
    }
}
