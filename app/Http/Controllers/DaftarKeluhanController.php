<?php

namespace App\Http\Controllers;

use App\Models\createKeluhan;
use App\Models\CreateTeknisi;
use App\Models\Jabatan;
use App\Models\Kategori;
use App\Models\SatuanKerja;
use App\Models\Lantai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarKeluhanController extends Controller
{
    public function edit($id)
    {
        $datakel = createKeluhan::findOrFail($id);
        $daftek = CreateTeknisi::all(); 
        $dafjabatan = Jabatan::all();
        $dafkategori = Kategori::all();
        $dafsatuankerja = SatuanKerja::all();
        $daflantai = Lantai::all(); 
        $user = Auth::user();
        $showEditButton = $user && $user->level == 1;

        return view('editkeluhan', compact('datakel', 'daftek', 'showEditButton', 'dafjabatan', 'dafkategori', 'dafsatuankerja', 'daflantai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keluhan' => 'required',
            'nip' => 'required',
            'nik' => 'required',
            'nama_pelapor' => 'required',
            'jabatan' => 'required',
            'kategori' => 'required',
            'teknisi' => 'required',
            'notadinas' => 'nullable',
            'deadline' => 'date',
            'satuankerja' => 'required',
            'lantai' => 'required',
            'rincian' => 'required',
            'status' => 'required',
        ]);

        $keluhan = createKeluhan::findOrFail($id);
        $keluhan->update($request->all());

        return redirect()->route('keluhan.berlangsung')
                        ->with('success', 'Data keluhan berhasil diperbarui.');
    }

    // Menampilkan keluhan yang belum selesai
    public function indexBerlangsung()
    {
        createKeluhan::where('status', '!=', 3)
            ->whereNotNull('deadline')
            ->whereDate('deadline', '<', Carbon::today())
            ->update(['status' => 4]);

        $dafkel = CreateKeluhan::where('status', '!=', 3)->get();
        return view('daftarkeluhan', compact('dafkel'));
    }

    // Menampilkan keluhan yang sudah selesai
    public function indexSelesai()
    {
        $dafkel = CreateKeluhan::where('status', 3)->get();
        return view('keluhanselesai', compact('dafkel'));
    }

    public function destroy(int $id)
    {
        $dafkel = createKeluhan::findOrFail($id);
        $dafkel->delete();
 
        return redirect()->route('daftarKeluhan')
            ->with('success', 'Keluhan berhasil dihapus.');
    }
}