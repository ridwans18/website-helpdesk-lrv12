<?php

namespace App\Http\Controllers;

use App\Models\createKeluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $jumlahOverdue = DB::table('createkeluhans')
            ->where('status', 4)
            ->count();

        $bulan = $request->input('bulan');
        
        $query = DB::table('createkeluhans')
            ->selectRaw('MONTH(created_at) as bulan, kategori, COUNT(*) as jumlah')
            ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
            ->groupBy('bulan', 'kategori')
            ->get();

        $keluhanPerBulanSimple = DB::table('createkeluhans')
            ->select(DB::raw('MONTH(created_at) as bulan'), DB::raw('COUNT(*) as jumlah'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $keluhanSelesaiPerTeknisi = DB::table('createkeluhans')
            ->select('teknisi', DB::raw('COUNT(*) as jumlah'))
            ->where('status', 3)
            ->groupBy('teknisi')
            ->pluck('jumlah', 'teknisi');
        
        $bulanList = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return view('home', [
            'keluhanPerBulan' => $query,
            'bulanList' => $bulanList,
            'keluhanSelesaiPerTeknisi' => $keluhanSelesaiPerTeknisi,
            'keluhanPerBulanSimple' => $keluhanPerBulanSimple,
            'jumlahOverdue' => $jumlahOverdue 
        ]);
    }
}