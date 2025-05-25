<?php

namespace App\Http\Controllers;

use App\Models\createKeluhan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DaftarKeluhanController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve filter inputs from the request
        $filters = $request->only([
            'keluhan',
            'nip',
            'nik',
            'nama_pelapor',
            'jabatan',
            'kategori',
            'teknisi',
            'notadinas',
            'satuankerja',
            'lantai',
            'rincian',
            'status',
        ]);

        // Start a query builder
        $query = createKeluhan::query();

        // Apply filters
        if (!empty($filters['keluhan'])) {
            $query->where('keluhan', 'like', '%' . $filters['keluhan'] . '%');
        }

        if (!empty($filters['nip'])) {
            $query->where('nip', 'like', '%' . $filters['nip'] . '%');
        }

        if (!empty($filters['nik'])) {
            $query->where('nik', 'like', '%' . $filters['nik'] . '%');
        }

        if (!empty($filters['nama_pelapor'])) {
            $query->where('nama_pelapor', 'like', '%' . $filters['nama_pelapor'] . '%');
        }

        if (!empty($filters['jabatan'])) {
            $query->where('jabatan', 'like', '%' . $filters['jabatan'] . '%');
        }

        if (!empty($filters['kategori'])) {
            $query->where('kategori', 'like', '%' . $filters['kategori'] . '%');
        }

        if (!empty($filters['teknisi'])) {
            $query->where('teknisi', 'like', '%' . $filters['teknisi'] . '%');
        }

        if (!empty($filters['santuankerja'])) {
            $query->where('satuankerja', 'like', '%' . $filters['satuankerja'] . '%');
        }

        if (!empty($filters['created_at'])) {
            $query->where('created_at', 'like', '%' . $filters['created_at'] . '%');
        }

        if (!empty($filters['status'])) {
            $query->where('status', 'like', '%' . $filters['status'] . '%');
        }

        // Paginate the filtered results
        $dafkel = $query->paginate(10);

        // Pass filters back to the view for better UX
        return view('daftarkeluhan', [
            'dafkel' => $dafkel,
            'filters' => $filters,
        ]);
    }

    public function destroy(int $id)
    {
        $dafkel = createKeluhan::findOrFail($id);
        $dafkel->delete();
 
        return redirect()->route('daftarKeluhan')
            ->with('success', 'Keluhan berhasil dihapus.');
    }
}