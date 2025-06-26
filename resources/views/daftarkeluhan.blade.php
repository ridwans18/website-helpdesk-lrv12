
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
                ['href' => route('keluhan.berlangsung'), 'class' => 'text-white bg-gray-900', 'text' => 'Daftar Keluhan'],
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
            {{-- @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif --}}
            
            <div class="mb-4 flex space-x-2">
                <a href="{{ route('keluhan.berlangsung') }}" class="px-4 py-2 bg-blue-500 btn btn-outline-primary active">Open</a>
                <a href="{{ route('keluhan.selesai') }}" class="px-4 py-2 btn btn-outline-primary">Close</a>
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
                <table class="min-w-full divide-y divide-gray-200 bg-white rounded-lg">
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
                            <th class="px-3 py-2 border">Aksi</th>
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
                            <td class="px-3 border text-center items-center">{{ $loop->iteration }}</td>
                            <td class="px-3 border">{{ $item->nama_pelapor }}</td>
                            <td class="px-3 border">{{ $item->keluhan }}</td>
                            <td class="px-3 border">{{ $item->kategori }}</td>
                            <td class="px-3 border">{{ $item->teknisi }}</td>
                            {{-- Badge Status --}}
                            <td class="px-3 border">
                                @switch($item->status)
                                    @case(1)
                                        <a class="inline-flex bg-gray-500 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Open
                                        </a>
                                        @break
                                    @case(2)
                                        <a class="inline-flex bg-yellow-500 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Diproses
                                        </a>
                                        @break
                                    @case(3)
                                        <a class="inline-flex bg-green-500 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Close
                                        </a>
                                        @break
                                    @case(4)
                                        <a class="inline-flex bg-red-700 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Overdue
                                        </a>
                                        @break
                                    @default
                                        <a class="inline-flex bg-red-700 text-white font-semibold py-1 px-3 rounded text-xs">
                                            Status Tidak Dikenal
                                        </a>
                                @endswitch
                            </td>

                            <td class="px-3 border">
                                {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') : '-' }}
                            </td>
                            <td class="px-3 border">
                                {{ $item->deadline ? \Carbon\Carbon::parse($item->deadline)->format('d-m-Y') : '-' }}
                            </td>

                            {{-- Button Aksi --}}
                            <td class="px-3 border p-2">
                                <div class="flex items-center gap-1">
                                    <!-- Kolom kiri: Status & Edit -->
                                    <div class="flex flex-col gap-1">
                                        <!-- Tombol Status -->
                                        <div class="relative inline-block text-left">
                                            <button 
                                                id="status-button-{{ $item->id }}"
                                                onclick="event.stopPropagation(); toggleDropdown({{ $item->id }})"
                                                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-1 px-2 rounded text-xs">
                                                Status
                                            </button>
                                            <div 
                                                id="dropdown-status-{{ $item->id }}"
                                                class="hidden origin-top-right absolute right-0 w-35 rounded-md shadow-lg bg-white z-10">
                                                <div class="py-1 text-sm text-gray-700">
                                                    {{-- <a onclick="event.stopPropagation(); changeStatus({{ $item->id }}, 1)" class="block px-3 py-2 hover:bg-gray-200">Open</a> --}}
                                                    <a onclick="event.stopPropagation(); changeStatus({{ $item->id }}, 2)" class="block px-3 py-2 hover:bg-yellow-200">Diproses</a>
                                                    <a onclick="event.stopPropagation(); changeStatus({{ $item->id }}, 3)" class="block px-3 py-2 hover:bg-green-200">Close</a>
                                                </div>
                                            </div>
                                        </div>

                                        <a 
                                            href="{{ route('daftarkeluhan.edit', $item->id) }}" 
                                            onclick="event.stopPropagation();"
                                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 text-center rounded text-xs">
                                            Edit
                                        </a>
                                    </div>

                                    <!-- Tombol Hapus -->
                                    <form 
                                        action="{{ route('daftarKeluhan.destroy', $item->id) }}" 
                                        method="POST" 
                                        onsubmit="event.stopPropagation(); return confirm('Yakin ingin menghapus?')"
                                        class="flex items-center h-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded text-xs">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Wrapper Modal -->
                <div id="detailModal" class="fixed inset-0 z-50 items-center justify-center hidden p-4">
                    <!-- Background Gelap -->
                    <div class="fixed inset-0 bg-black opacity-30" onclick="closeModal()"></div>

                    <!-- Kotak Modal -->
                        <div 
                            class="relative bg-white rounded-lg shadow-lg 
                                w-auto max-w-[70vh] mx-auto 
                                max-h-[70vh] overflow-y-auto 
                                ooverflow-y-auto p-4 z-10"
                            onclick="event.stopPropagation();"
                        >
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold mb-3">Detail Informasi</h3>
                            <button onclick="closeModal()" class="text-gray-500 hover:text-black text-xl font-bold mb-4">
                                &times;
                            </button>
                        </div>

                        <div class="text-sm grid grid-cols-[auto,1fr] gap-x-2 gap-y-2">
                            <strong>NIP:</strong> <span id="modal-nip" class="whitespace-pre-line block"></span>
                            <strong>NIK:</strong> <span id="modal-nik" class="whitespace-pre-line block"></span>
                            <strong>Jabatan:</strong> <span id="modal-jabatan" class="whitespace-pre-line block"></span>
                            <strong>Nota Dinas:</strong> <span id="modal-notadinas" class="whitespace-pre-line block"></span>
                            <strong>Satuan Kerja:</strong> <span id="modal-satuankerja" class="whitespace-pre-line block"></span>
                            <strong>Lantai:</strong> <span id="modal-lantai" class="whitespace-pre-line block"></span>
                            <strong>Rincian:</strong> <span id="modal-rincian" class="whitespace-pre-line block"></span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        
        <x-footer />
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
    
    {{-- Dropdown Button Ubah Status --}}
    <script>
        function toggleDropdown(id) {
            // Tutup semua dropdown lain terlebih dahulu
            const allDropdowns = document.querySelectorAll('[id^="dropdown-status-"]');
            allDropdowns.forEach(dropdown => {
                if (dropdown.id !== 'dropdown-status-' + id) {
                    dropdown.classList.add('hidden');
                }
            });

            // Toggle dropdown yang diklik
            const dropdown = document.getElementById('dropdown-status-' + id);
            dropdown.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const allDropdowns = document.querySelectorAll('[id^="dropdown-status-"]');

            allDropdowns.forEach(dropdown => {
                const btnId = 'status-button-' + dropdown.id.split('-').pop();
                const button = document.getElementById(btnId);

                if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });

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
                showSuccessNotification(); // tampilkan notif sukses

                setTimeout(() => {
                    location.reload(); // refresh setelah 2 detik
                }, 150);
            })
            .catch(error => {
                showErrorNotification(); // tampilkan notif error
                console.error('Error:', error);
            });
        }
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

