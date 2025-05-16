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
            <x-navbar></x-navbar>
        </div>

        <!-- Start Content -->
        <main class="flex-grow container mx-auto px-4 py-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center">No</th>
                            <th class="px-4 py-3 text-center">NIP</th>
                            <th class="px-4 py-3 text-center">NIK</th>
                            <th class="px-4 py-3">Nama Pelapor</th>
                            <th class="px-4 py-3">Keluhan</th>
                            <th class="px-4 py-3">Jabatan</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Teknisi</th>
                            <th class="px-4 py-3">Satuan Kerja</th>
                            <th class="px-4 py-3">Lantai</th>
                            <th class="px-4 py-3">Tanggal Lapor</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="" class="text-sm divide-y divide-gray-100">
                        @foreach($dafkel as $item)
                        <tr onclick="showDetails('Maria')" class="hover:bg-gray-100 cursor-pointer">
                            <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->nip }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->nik }}</td>
                            <td class="px-4 py-2">{{ $item->nama_pelapor }}</td>
                            <td class="px-4 py-2">{{ $item->keluhan }}</td>
                            <td class="px-4 py-2">{{ $item->jabatan }}</td>
                            <td class="px-4 py-2">{{ $item->kategori }}</td>
                            <td class="px-4 py-2">{{ $item->teknisi }}</td>
                            <td class="px-4 py-2">{{ $item->satuankerja }}</td>
                            <td class="px-4 py-2">{{ $item->lantai }}</td>
                            <td class="px-4 py-2">{{ $item->created_at }}</td>
                            <td class="px-4 py-2">
                                <a type="submit" href="{{ route('admin.daftarkeluhan.edit', $item->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded text-xs">
                                    Ubah
                                </a>
                                <form action="{{ route('admin.daftarKeluhan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                     <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>


            </main>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-gray-800 text-white mt-auto">
            <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-sm text-gray-400 mb-0 mt-2">&copy; 2025 Sistem Keluhan. All rights reserved.</p>
                    <div class="flex space-x-4 mt-2">
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Privacy Policy</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Terms of Service</a>
                    <a href="#" class="text-gray-400 hover:text-white text-sm">Contact</a>
                </div>
            </div>
        </footer>
        
        <script>
        function showDetails(customerID) {
            let details;
            switch (customerID) {
            case 'Maria':
                details = 'Detail untuk Maria: Network Issue, Teknisi Akbar Wahyu, Tenggat Waktu 15 Juni, 2025';
                break;
            case 'Anar':
                details = 'Detail untuk ANAR: Login Issue, Teknisi Wahyu Mekar, Tenggat Waktu 30 Juni, 2025';
                break;
            default:
                details = 'Detail belum tersedia.';
            }
            document.getElementById('detailText').innerText = details;
            document.getElementById('detailModal').classList.remove('hidden');
        }
    
        function closeDetails() {
            document.getElementById('detailModal').classList.add('hidden');
        }
        </script>
    </body>
</html>

