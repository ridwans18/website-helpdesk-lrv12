
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
        @php
            $user = Auth::user();
            $navbarLinks = [
                ['href' => '/', 'text' => 'Home'],
                ['href' => '../beranda', 'text' => 'Beranda'],
                ['href' => route('daftarKeluhan'), 'class' => 'text-white bg-gray-900', 'text' => 'Daftar Keluhan'],
                ['href' => '../laporan', 'text' => 'Laporan'],
            ];

            if ($user && $user->level == 1) {
                $navbarLinks[] = ['href' => '../register', 'text' => 'Kelola User'];
            }
        @endphp

        <div class="min-h-full">
            <x-navbar :links="$navbarLinks" />
        </div>
        
        <!-- Start Content -->
        <main class="flex-grow container mx-auto px-4 py-6">
            <div class="mb-4 flex space-x-2">
                <a href="{{ route('keluhan.berlangsung') }}" class="px-4 py-2 btn btn-outline-primary font-bold">Open</a>
                <a href="{{ route('keluhan.selesai') }}" class="px-4 py-2 btn btn-outline-primary active font-bold">Close</a>
            </div>
            <div class="overflow-x-auto">
                {{-- Notif Berhsisil --}}
                <div 
                    id="status-notif" 
                    class="fixed mt-3 font-bold top-14 right-14 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50 hidden transition transform scale-95 opacity-0">
                        Status berhasil diubah.
                </div>
                <div id="error-notif"
                    class="fixed mt-3 font-bold top-14 right-14 bg-red-500 text-white px-4 py-2 rounded shadow-lg z-50 hidden transition transform scale-95 opacity-0">
                    Gagal mengubah status.
                </div>
                {{-- Tabel Daftar Keluhan --}}
                <table class="min-w-full divide-y divide-gray-200 bg-white shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-200 text-gray-700 text-sm uppercase tracking-wider">
                        <tr>
                            <th class="px-3 py-2 border">No</th>
                            <th class="px-3 py-2 border">Nama Pelapor</th>
                            <th class="px-3 py-2 border">Keluhan</th>
                            <th class="px-3 py-2 border">Kategori</th>
                            <th class="px-3 py-2 border">Teknisi</th>
                            <th class="px-3 py-2 border">Status</th>
                            <th class="px-3 py-2 border">Tanggal Lapor</th>
                            <th class="px-3 py-2 border">Tenggat Waktu</th>
                        </tr>
                    </thead>
                    <tbody id="" class="text-sm divide-y divide-gray-100">
                        @foreach($dafkel as $item)
                            <tr class="hover:bg-gray-100 cursor-pointer" onclick="showDetailModal({{ json_encode([
                                'nip' => $item->nip,
                                'nik' => $item->nik,
                                'jabatan' => $item->jabatan,
                                'notadinas' => $item->notadinas,
                                'satuankerja' => $item->satuankerja,
                                'lantai' => $item->lantai,
                                'rincian' => $item->rincian,
                            ]) }})">
                            <td class="px-3 py-2 border text-center items-center">{{ $loop->iteration }}</td>
                            <td class="px-3 py-2 border">{{ $item->nama_pelapor }}</td>
                            <td class="px-3 py-2 border">{{ $item->keluhan }}</td>
                            <td class="px-3 py-2 border">{{ $item->kategori }}</td>
                            <td class="px-3 py-2 border">{{ $item->teknisi }}</td>
                            {{-- Badge Status --}}
                            <td class="px-3 py-2 border">
                                @switch($item->status)
                                    @case(1)
                                        <a class="inline-flex bg-gray-500 text-white font-semibold px-3 py-2 rounded text-xs">
                                            Open
                                        </a>
                                        @break
                                    @case(2)
                                        <a class="inline-flex bg-yellow-500 text-white font-semibold px-3 py-2 rounded text-xs">
                                            Diproses
                                        </a>
                                        @break
                                    @case(3)
                                        <a class="inline-flex bg-green-500 text-white font-semibold px-3 py-2 rounded text-xs">
                                            Close
                                        </a>
                                        @break
                                    @default
                                        <a class="inline-flex bg-red-500 text-white font-semibold px-3 py-2 rounded text-xs">
                                            Status Tidak Dikenal
                                        </a>
                                @endswitch
                            </td>

                            <td class="px-3 py-2 border">
                                {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') : '-' }}
                            </td>
                            <td class="px-3 py-2 border">
                                {{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('Y-m-d') : '-' }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Wrapper Modal -->
                <div id="detailModal" class="fixed inset-0 z-50 items-center justify-center hidden">
                    <!-- Background Gelap -->
                    <div class="fixed inset-0 bg-black opacity-30" onclick="closeModal()"></div>

                    <!-- Kotak Modal -->
                    <div class="relative bg-white rounded-lg shadow-lg w-96 p-5 z-10" onclick="event.stopPropagation();">
                        <h3 class="text-lg font-semibold mb-3">Detail Informasi</h3>
                        <ul class="text-sm space-y-1">
                            <li><strong>NIP:</strong> <span id="modal-nip"></span></li>
                            <li><strong>NIK:</strong> <span id="modal-nik"></span></li>
                            <li><strong>Jabatan:</strong> <span id="modal-jabatan"></span></li>
                            <li><strong>Nota Dinas:</strong> <span id="modal-notadinas"></span></li>
                            <li><strong>Satuan Kerja:</strong> <span id="modal-satuankerja"></span></li>
                            <li><strong>Lantai:</strong> <span id="modal-lantai"></span></li>
                            <li><strong>Rincian:</strong> <span id="modal-rincian"></span></li>
                        </ul>

                        <!-- Tombol Tutup -->
                        <button onclick="closeModal()" class="absolute top-2 right-4 text-gray-500 hover:text-black text-xl font-bold">&times;</button>
                    </div>
                </div>
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
    </body>

    <script>
        function showDetailModal(data) {
            document.getElementById('modal-nip').textContent = data.nip || '-';
            document.getElementById('modal-nik').textContent = data.nik || '-';
            document.getElementById('modal-jabatan').textContent = data.jabatan || '-';
            document.getElementById('modal-notadinas').textContent = data.notadinas || '-';
            document.getElementById('modal-satuankerja').textContent = data.satuankerja || '-';
            document.getElementById('modal-lantai').textContent = data.lantai || '-';
            document.getElementById('modal-rincian').textContent = data.rincian || '-';
            const modal = document.getElementById('detailModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</html>

