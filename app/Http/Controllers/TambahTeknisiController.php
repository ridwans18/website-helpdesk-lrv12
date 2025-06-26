<?php

namespace App\Http\Controllers;

use App\Models\createTeknisi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TambahTeknisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function create()
    {
        $teknisis = CreateTeknisi::all(); 
        return view('beranda', compact('teknisis'));
    }

    public function store(Request $request)
    {
    $action = $request->input('action'); 
    $ids = $request->input('teknisi_id', []); 

    if ($action === 'simpan') {
        if ($request->filled('nama_teknisi')) {
            CreateTeknisi::create([
                'nama_teknisi' => $request->nama_teknisi
            ]);
            return back()->with('success', 'Teknisi berhasil ditambahkan.');
        } else {
            return back()->with('error', 'Nama teknisi tidak boleh kosong.');
        }
    }

    if ($action === 'hapus') {
        if (!empty($ids)) {
            CreateTeknisi::destroy($ids);
            return back()->with('success', 'Teknisi yang dipilih berhasil dihapus.');
        } else {
            return back()->with('error', 'Tidak ada teknisi yang dipilih untuk dihapus.');
        }
    }

    return back()->with('error', 'Aksi tidak dikenali.');
    }
}
