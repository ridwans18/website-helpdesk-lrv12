<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\createKeluhan;
use App\Models\CreateTeknisi;
use Illuminate\Http\Request;

class berandaController extends Controller
{
    /**
     * menampilkan semua teknisi.
     */
    public function index(Request $request)
    {
        // Retrieve filter inputs from the request
        $filters = $request->only([
            'nama_teknisi',
        ]);

        // Start a query builder
        $query = CreateTeknisi::query();

        // Apply filters
        if (!empty($filters['nama_teknisi'])) {
            $query->where('nama_teknisi', 'like', '%' . $filters['nama_teknisi'] . '%');
        }
        
        // Paginate the filtered results
        $daftek = $query->paginate(10);

        // Pass filters back to the view for better UX
        return view('beranda', [
            'daftek' => $daftek,
            'filters' => $filters,
        ]);
    }

        public function destroy(int $id)
    {
        $daftek = CreateTeknisi::findOrFail($id);
        $daftek->delete();
 
        return redirect()->route('beranda')
            ->with('success', 'Keluhan berhasil dihapus.');
    }

    /**
     * membuat keluhan baru.
     */
    public function create()
    {
        return view('admin.beranda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required',
            'nip' => 'required',
            'nik' => 'required',
            'nama_pelapor' => 'required',
            'jabatan' => 'required',
            'kategori' => 'required',
            'teknisi' => 'required',
            'satuankerja' => 'required',
            'lantai' => 'required',
        ]);

        createkeluhan::create($request->only([
            'keluhan',
            'nip',
            'nik',
            'nama_pelapor',
            'jabatan',
            'kategori',
            'teknisi',
            'satuankerja',
            'lantai',
        ]));

        return redirect()->back()->with('success', 'Keluhan berhasil disimpan!');
    }

        /**
     * merubah data keluhan.
     */
   public function edit($id)
   {
       $datakel = createKeluhan::findOrFail($id);
       $daftek = CreateTeknisi::all();

       return view('editkeluhan', compact('datakel', 'daftek')); 
   }

   
   public function update(Request $request, string $id)
   {
       $request->validate([
            'keluhan' => 'required',
            'nip' => 'required',
            'nik' => 'required',
            'nama_pelapor' => 'required',
            'jabatan' => 'required',
            'kategori' => 'required',
            'teknisi' => 'required',
            'satuankerja' => 'required',
            'lantai' => 'required',
       ]);

       $datakel = createKeluhan::findOrFail($id);
       $datakel->update($request->all());

       return redirect()->route('admin.daftarKeluhan')
           ->with('success', 'Laporan berhasil diperbarui.');
   }

   public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:1,2,3',
        ]);

        $keluhan = createKeluhan::findOrFail($id);
        $keluhan->status = $request->status;
        $keluhan->save();

        return response()->json(['message' => 'Status berhasil diubah.']);
    }
}
