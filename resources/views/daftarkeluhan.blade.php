
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
                ['href' => '/', 'text' => 'Home'],
                ['href' => 'beranda', 'text' => 'Beranda'],
                ['href' => route('daftarKeluhan'), 'class' => 'text-white bg-gray-900', 'text' => 'Daftar Keluhan'],
                ['href' => 'laporan', 'text' => 'Laporan'],
            ]" />
        </div>
        <!-- Start Content -->
        <main class="flex-grow container mx-auto px-4 py-6">
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
                            <th class="px-4 py-3">No</th>
                            <th class="px-4 py-3">NIP</th>
                            <th class="px-4 py-3">NIK</th>
                            <th class="px-4 py-3">Nama Pelapor</th>
                            <th class="px-4 py-3">Keluhan</th>
                            <th class="px-4 py-3">Jabatan</th>
                            <th class="px-4 py-3">Kategori</th>
                            <th class="px-4 py-3">Teknisi</th>
                            <th class="px-4 py-3">Satuan Kerja</th>
                            <th class="px-4 py-3">Lantai</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal Lapor</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="" class="text-sm divide-y divide-gray-100">
                        @foreach($dafkel as $item)
                        <tr onclick="showDetails('Maria')" class="hover:bg-gray-100 cursor-pointer">
                            <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $item->nip }}</td>
                            <td class="px-4 py-2">{{ $item->nik }}</td>
                            <td class="px-4 py-2">{{ $item->nama_pelapor }}</td>
                            <td class="px-4 py-2">{{ $item->keluhan }}</td>
                            <td class="px-4 py-2">{{ $item->jabatan }}</td>
                            <td class="px-4 py-2">{{ $item->kategori }}</td>
                            <td class="px-4 py-2">{{ $item->teknisi }}</td>
                            <td class="px-4 py-2">{{ $item->satuankerja }}</td>
                            <td class="px-4 py-2">{{ $item->lantai }}</td>
                            {{-- Badge Status --}}
                            <td class="px-4 py-2">
                                @switch($item->status)
                                    @case(1)
                                        <a class="inline-flex bg-gray-500 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Menunggu Konfirmasi
                                        </a>
                                        @break
                                    @case(2)
                                        <a class="inline-flex bg-yellow-500 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Diproses
                                        </a>
                                        @break
                                    @case(3)
                                        <a class="inline-flex bg-green-500 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Selesai
                                        </a>
                                        @break
                                    @default
                                        <a class="inline-flex bg-red-500 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Status Tidak Dikenal
                                        </a>
                                @endswitch
                            </td>
                            <td class="px-4 py-2">{{ $item->created_at }}</td>
                            {{-- Button Aksi --}}
                            <td class="px-6 py-2">
                                <div class="relative inline-block text-left">
                                    <button onclick="toggleDropdown(event)" class="mb-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-1 px-3 rounded text-xs">
                                        Ubah Status
                                    </button>

                                    <div class="hidden origin-top-right absolute right-0 w-35 rounded-md shadow-lg bg-white z-10" id="dropdown-status">
                                        <div class="py-1 text-sm text-gray-700">
                                            <a onclick="changeStatus({{ $item->id }}, 1)" class="block px-4 py-2 hover:bg-gray-200">Menunggu Konfirmasi</a>
                                            <a onclick="changeStatus({{ $item->id }}, 2)" class="block px-4 py-2 hover:bg-yellow-200">Diproses</a>
                                            <a onclick="changeStatus({{ $item->id }}, 3)" class="block px-4 py-2 hover:bg-green-200">Selesai</a>
                                        </div>
                                    </div>
                                </div>
                                <a type="submit" href="{{ route('daftarkeluhan.edit', $item->id) }}" class="mb-1 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded text-xs">
                                    Ubah Data
                                </a>
                                <form action="{{ route('daftarKeluhan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                     <button type="submit" class="mb-1 bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded text-xs">
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
    </body>
    
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
    
    {{-- Dropdown Button Ubah Status --}}
    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdown = event.currentTarget.nextElementSibling;

            // Tutup semua dropdown lain
            document.querySelectorAll('.dropdown-menu').forEach(el => {
                if (el !== dropdown) el.classList.add('hidden');
            });

            // Toggle dropdown saat ini
            dropdown.classList.toggle('hidden');
        }

        function changeStatus(id, status) {
            fetch(`/ubah-status/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: status })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengubah status');
                }
                return response.json();
            })
            .then(data => {
                showSuccessNotification(); // ✅ tampilkan notif sukses

                setTimeout(() => {
                    location.reload(); // 🔄 refresh setelah 2 detik
                }, 2000);
            })
            .catch(error => {
                showErrorNotification(); // ❌ tampilkan notif error
                console.error('Error:', error);
            });
        }

        // Tutup dropdown jika klik di luar area dropdown
        window.addEventListener('click', function (e) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    </script>

    
    {{-- Fungsi menampilkan notif --}}
    <script>
        function showSuccessNotification() {
            const notif = document.getElementById('status-notif');

            // Hapus kelas hidden dan tampilkan dengan animasi
            notif.classList.remove('hidden');
            notif.classList.remove('opacity-0', 'scale-95');
            notif.classList.add('opacity-100', 'scale-100');

            // Sembunyikan kembali setelah 3 detik
            setTimeout(() => {
                notif.classList.add('opacity-0', 'scale-95');
                notif.classList.remove('opacity-100', 'scale-100');

                // Sembunyikan elemen sepenuhnya setelah animasi selesai
                setTimeout(() => {s
                    notif.classList.add('hidden');
                }, 300); // delay sesuai durasi transisi
            }, 3000);
        }

        function showErrorNotification() {
            const notif = document.getElementById('error-notif');
            notif.classList.remove('hidden');
            notif.classList.remove('opacity-0', 'scale-95');
            notif.classList.add('opacity-100', 'scale-100');

            setTimeout(() => {
                notif.classList.add('opacity-0', 'scale-95');
                notif.classList.remove('opacity-100', 'scale-100');
                setTimeout(() => {
                    notif.classList.add('hidden');
                }, 300);
            }, 3000);
        }
    </script>
</html>

