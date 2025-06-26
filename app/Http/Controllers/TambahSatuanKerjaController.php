<?php

namespace App\Http\Controllers;

use App\Models\SatuanKerja;
use Illuminate\Http\Request;

class TambahSatuanKerjaController extends Controller
{
    public function store(Request $request)
    {
        $action = $request->input('action');
        $ids = $request->input('satuan_id', []);

        if ($action === 'simpan') {
            if ($request->filled('nama_satuankerja')) {
                SatuanKerja::create([
                    'nama_satuankerja' => $request->nama_satuankerja
                ]);
                return back()->with('success', 'Satuan Kerja berhasil ditambahkan.');
            } else {
                return back()->with('error', 'Nama Satuan Kerja tidak boleh kosong.');
            }
        }

        if ($action === 'hapus') {
            if (!empty($ids)) {
                SatuanKerja::destroy($ids);
                return back()->with('success', 'Satuan Kerja yang dipilih berhasil dihapus.');
            } else {
                return back()->with('error', 'Tidak ada Satuan Kerja yang dipilih untuk dihapus.');
            }
        }

        return back()->with('error', 'Aksi tidak dikenali.');
    }
}
