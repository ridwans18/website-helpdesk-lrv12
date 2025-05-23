<!DOCTYPE html>
<html class="h-full bg-gray-100">
    <head>
        <title>Daftar Keluhan - Helpdesk</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="flex flex-col min-h-screen d-flex flex-column min-vh-100">
        <div class="min-h-full">
            <x-navbar :links="[
                ['href' => url('/'), 'text' => 'Home'],
                ['href' => url('beranda'), 'text' => 'Beranda'],
                ['href' => url('daftarkeluhan'), 'text' => 'Daftar Keluhan'],
                ['href' => 'laporan', 'text' => 'Laporan', 'class' => 'text-white bg-gray-900'],
            ]" />
        </div>

        <div class="max-w-7xl mx-auto mt-10 bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold mb-6 text-gray-800">📄 Cetak Laporan Berdasarkan Tanggal</h2>

        <form action="{{ route('laporan.tampilkan') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end mb-6">
            <div>
                <label for="tanggal_awal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
                <label for="tanggal_akhir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-md shadow">Tampilkan</button>
            </div>
        </form>

        @if(request('tanggal_awal') && request('tanggal_akhir'))
        <form action="{{ route('laporan.cetak') }}" method="POST" target="_blank" class="flex flex-col md:flex-row md:items-center gap-2 mb-4">
            @csrf
            <input type="hidden" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
            <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md shadow">
                🖨️ Cetak PDF
            </button>

            <div>
                <input type="text" name="nama_file" placeholder="Nama file (opsional)" class="border border-gray-300 rounded-md py-2 px-3 w-full focus:outline-none focus:ring focus:border-blue-400" />
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm border border-gray-200 rounded-md overflow-hidden">
                <thead class="bg-gray-100 text-gray-700 text-sm font-semibold">
                    <tr>
                        <th class="px-3 py-2 border">No</th>
                        <th class="px-3 py-2 border">NIP</th>
                        <th class="px-3 py-2 border">NIK</th>
                        <th class="px-3 py-2 border">Nama</th>
                        <th class="px-3 py-2 border">Keluhan</th>
                        <th class="px-3 py-2 border">Jabatan</th>
                        <th class="px-3 py-2 border">Kategori</th>
                        <th class="px-3 py-2 border">Teknisi</th>
                        <th class="px-3 py-2 border">Satuan Kerja</th>
                        <th class="px-3 py-2 border">Lantai</th>
                        <th class="px-3 py-2 border">Tanggal</th>
                        <th class="px-3 py-2 border">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-800">
                    @foreach($data as $item)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="px-3 py-2 border text-center">{{ $loop->iteration }}</td>
                        <td class="px-3 py-2 border">{{ $item->nip }}</td>
                        <td class="px-3 py-2 border">{{ $item->nik }}</td>
                        <td class="px-3 py-2 border">{{ $item->nama_pelapor }}</td>
                        <td class="px-3 py-2 border">{{ $item->keluhan }}</td>
                        <td class="px-3 py-2 border">{{ $item->jabatan }}</td>
                        <td class="px-3 py-2 border">{{ $item->kategori }}</td>
                        <td class="px-3 py-2 border">{{ $item->teknisi }}</td>
                        <td class="px-3 py-2 border">{{ $item->satuankerja }}</td>
                        <td class="px-3 py-2 border text-center">{{ $item->lantai }}</td>
                        <td class="px-3 py-2 border text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td class="px-3 py-2 border text-center">
                            @switch($item->status)
                                @case(1) <span class="text-gray-600">Menunggu</span> @break
                                @case(2) <span class="text-yellow-600">Diproses</span> @break
                                @case(3) <span class="text-green-600">Selesai</span> @break
                                @default <span class="text-red-600">Tidak Diketahui</span>
                            @endswitch
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    </body>
</html>
