<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\createKeluhan;
use App\Models\CreateTeknisi;
use App\Models\Jabatan;
use App\Models\Kategori;
use App\Models\SatuanKerja;
use App\Models\Lantai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class berandaController extends Controller
{
    /**
     * menampilkan data.
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

        // Ambil user login
        $user = Auth::user();

        // Cek level
        $showEditButton = $user && $user->level == 1;

        // Ambil data 
        $dafjabatan = Jabatan::select('id', 'nama_jabatan')->get();
        $dafkategori = Kategori::select('id', 'nama_kategori')->get();
        $dafsatuankerja = SatuanKerja::select('id', 'nama_satuankerja')->get();
        $daflantai = Lantai::select('id', 'nama_lantai')->get();

        // Kirim ke view
        return view('beranda', [
            'daftek' => $daftek,
            'filters' => $filters,
            'showEditButton' => $showEditButton,
            'dafjabatan' => $dafjabatan,
            'dafkategori' => $dafkategori,
            'dafsatuankerja' => $dafsatuankerja,
            'daflantai' => $daflantai,
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
        return view('beranda.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'keluhan' => 'required',
            'nip' => 'required',
            'nik' => 'required',
            // 'nama_pelapor' => 'required',
            'jabatan' => 'required',
            'kategori' => 'required',
            'teknisi' => 'required',
            'notadinas' => 'nullable',
            'deadline' => 'date',
            'satuankerja' => 'required',
            'lantai' => 'required',
            'rincian' => 'nullable',
        ]);

        $data = $request->only([
            'keluhan',
            'nip',
            'nik',
            'nama_pelapor', 
            'jabatan',
            'kategori',
            'teknisi',
            'notadinas',
            'deadline', 
            'satuankerja',
            'lantai',
            'rincian',
        ]);

        $data['nama_pelapor'] = Auth::user()->name;
        $data['status'] = 1; 

        createkeluhan::create($data);

        return redirect()->back()->with('success', 'Keluhan berhasil disimpan!');
    }

    /**
     * merubah data keluhan.
     */
   public function edit($id)
   {
       $datakel = createKeluhan::findOrFail($id);
       $daftek = CreateTeknisi::all();
       $dafjabatan = Jabatan::select('id', 'nama_jabatan')->get();
       $dafkategori = Kategori::select('id', 'nama_kategori')->get();
       $dafsatuankerja = SatuanKerja::select('id', 'nama_satuankerja')->get();
       $daflantai = Lantai::select('id', 'nama_lantai')->get();

       return view('editkeluhan', compact('datakel', 'daftek', 'dafjabatan', 'dafkategori', 'dafsatuankerja', 'daflantai')); 
   }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'keluhan' => 'required|string|max:100',
            'nip' => 'required|numeric',
            'nik' => 'required|numeric',
            'nama_pelapor' => 'required|string|max:100',
            'jabatan' => 'required|string|max:100',
            'kategori' => 'required|string|max:100',
            'teknisi' => 'required|string|max:100',
            'notadinas' => 'nullable|string|max:100',
            'deadline' => 'nullable|date',
            'satuankerja' => 'required|string|max:100',
            'lantai' => 'required|string|max:100',
            'rincian' => 'nullable|string',
        ]);

        try {
            $data = createKeluhan::findOrFail($id);
            $data->update($request->all());

            return redirect()->route('daftarKeluhan')->with('success', 'Data berhasil diperbarui');
            } catch (QueryException $e) {
                Log::error('Update error: ' . $e->getMessage());

        $errors = new MessageBag();
        $errorMessage = $e->getMessage();

        // Daftar kolom yang mungkin error karena panjang melebihi batas
        $kolomMap = [
            'keluhan' => 'Kolom keluhan terlalu panjang atau mengandung karakter tidak valid.',
        ];

        $errorDetected = false;

        foreach ($kolomMap as $field => $msg) {
            if (Str::contains($errorMessage, "'$field'")) {
                $errors->add($field, $msg);
                $errorDetected = true;
            }
        }

        if ($errorDetected) {
            $errors->add('form', 'Gagal memperbarui data. Pastikan semua input sudah sesuai.');
        } else {
            $errors->add('form', 'Gagal memperbarui data karena kesalahan sistem.');
        }

        return redirect()->back()->withInput()->withErrors($errors);
        }
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
