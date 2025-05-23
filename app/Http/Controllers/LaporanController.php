<?php

namespace App\Http\Controllers;

use App\Models\createkeluhan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan.index'); // hanya form
    }

    public function tampilkan(Request $request)
    {
        $data = Createkeluhan::whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->get();

        return view('laporan.index', compact('data'));
    }

    public function cetak(Request $request)
    {
        $nama_file = $request->nama_file ?: 'laporan-keluhan';
        $data = Createkeluhan::whereBetween('created_at', [$request->tanggal_awal, $request->tanggal_akhir])->get();

        $pdf = Pdf::loadView('laporan.pdf', ['data' => $data, 'request' => $request]);
        return $pdf->download($nama_file . '.pdf');
    }
}

