<?php

namespace App\Http\Controllers;

use App\Models\createkeluhan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index'); 
    }

    public function tampilkan(Request $request)
    {
        $start = Carbon::parse($request->tanggal_awal)->startOfDay(); // 00:00:00
        $end = Carbon::parse($request->tanggal_akhir)->endOfDay(); // 23:59:59

        $data = Createkeluhan::whereBetween('created_at', [$start, $end])->get();

        return view('laporan.index', compact('data'));
    }

    public function cetak(Request $request)
    {
        $nama_file = $request->nama_file ?: 'laporan-keluhan';

        $start = Carbon::parse($request->tanggal_awal)->startOfDay(); // 00:00:00
        $end = Carbon::parse($request->tanggal_akhir)->endOfDay();     // 23:59:59

        $data = Createkeluhan::whereBetween('created_at', [$start, $end])->get();

        // 👉 Set paper ke A4 dan orientasi ke landscape
        $pdf = Pdf::loadView('laporan.pdf', [
            'data' => $data,
            'request' => $request
        ])->setPaper('a4', 'landscape');

        return $pdf->download($nama_file . '.pdf');
    }
}

