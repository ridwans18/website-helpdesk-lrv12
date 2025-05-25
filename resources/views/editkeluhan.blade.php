<!DOCTYPE html>
<html class="h-full bg-gray-100">
    <head>
        <title>Ubah Laporan - Helpdesk</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="flex flex-col min-h-screen d-flex flex-column min-vh-100">
        
        <main class="flex-grow container mx-auto px-4 py-6">
            <!-- Start Content -->
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-semibold mb-6">Ubah Laporan</h2>

                <!-- Report Information -->
                <form action="{{ route('keluhan.update', $datakel->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Quick Report -->
                    <div class="mb-4">
                        <input 
                            type="text" 
                            for="keluhan" 
                            id="keluhan" 
                            name="keluhan" 
                            value="{{ $datakel->keluhan }}" 
                            class="w-full border border-gray-300 rounded px-4 py-2" 
                            placeholder="Keluhan"
                        >
                    </div>
                    <!-- Grid Content -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="nip" class="block font-medium">NIP*</label>
                            <input 
                                type="number" 
                                id="nip" 
                                name="nip" 
                                value="{{ $datakel->nip }}"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="nik" class="block font-medium">NIK</label>
                            <input 
                                type="number" 
                                id="nik" name="nik" 
                                value="{{ $datakel->nik }}"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="nama_pelapor" class="block font-medium">Nama Pelapor*</label>
                            <input 
                                type="text" 
                                id="nama_pelapor" 
                                name="nama_pelapor" 
                                value="{{ $datakel->nama_pelapor }}"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="jabatan" class="block font-medium">Jabatan*</label>
                            <input 
                                type="text" 
                                id="jabatan" 
                                name="jabatan" 
                                value="{{ $datakel->jabatan }}"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="kategori" class="block font-medium">Kategori*</label>
                            <input 
                                type="text" 
                                id="kategori" 
                                name="kategori" 
                                value="{{ $datakel->kategori }}"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="teknisi" class="block font-medium">Teknisi*</label>
                            <div class="flex flex-row items-center justify-between gap-2">
                                <select 
                                    id="teknisi" 
                                    name="teknisi"
                                    class="col-span-3 w-full border border-gray-300 rounded px-3 py-2">
                                        <option>{{ $datakel->teknisi }}</option>
                                        @forelse($daftek as $item)
                                            <option>{{ $item->nama_teknisi }}</option>
                                            @empty
                                            <p>Tidak ada teknisi.</p>
                                        @endforelse
                                </select>
                                {{-- Button Edit Teknisi --}}
                                <div class="flex gap-2">
                                    <x-heroicon-c-pencil-square 
                                        type="button" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ubahModal" 
                                        class="w-6"
                                    />
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="notadinas" class="block font-medium">Nota Dinas</label>
                            <input type="text" id="notadinas" class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>
                    </div>
                

                    <!-- Schedule Report -->
                    <h4 class="text-lg font-semibold mb-2">Jadwal Pelaporan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="tanggallapor" class="block font-medium">Tanggal Lapor*</label>
                            <input type="date" id="tanggallapor" class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>
                        <div>
                            <label for="tenggatwaktu" class="block font-medium">Tenggat Waktu*</label>
                            <input type="date" id="tenggatwaktu" class="w-full border border-gray-300 rounded px-3 py-2">
                        </div>
                    </div>

                    <!-- Location Information -->
                    <h4 class="text-lg font-semibold mb-2">Lokasi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="region" class="block font-medium">Satuan Kerja*</label>
                            <select 
                                id="region" 
                                name="satuankerja"
                                class="w-full border border-gray-300 rounded px-3 py-2">
                                    <option>Tata Keloka TIK</option>
                                    <option>Tata Usaha</option>
                                    <option>Pengembangan</option>
                                    <option>Operasional</option>
                            </select>
                        </div>
                        <div>
                            <label for="state" class="block font-medium">Lantai</label>
                            <select 
                                id="state" 
                                name="lantai" 
                                class="w-full border border-gray-300 rounded px-3 py-2">
                                    <option>Lt.1</option>
                                    <option>Lt.2</option>
                                    <option>Lt.3</option>
                                    <option>Lt.4</option>
                            </select>
                        </div>
                    </div>

                    <!-- Extended Information -->
                    <h4 class="text-lg font-semibold mb-2">Rincian</h4>
                    <div class="mb-6">
                        <textarea id="description" rows="4" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Tambahan?"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="text-end">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-2" type="submit">Simpan</button>
                        <a href="{{ route('daftarKeluhan') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Batal</a>
                    </div>
                </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="ubahModal" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ubahModalLabel">Tambah/Hapus Nama Teknisi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('TambahTeknisi.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <!-- Tambah teknisi baru -->
                                <div class="mb-3">
                                    <h6>Tambah Teknisi</h6>
                                    <input type="text" class="form-control" name="nama_teknisi" placeholder="Masukkan nama teknisi">
                                </div>

                                <!-- Checklist teknisi yang ada -->
                                <h6>Teknisi yang Ada</h6>
                                @forelse($daftek as $item)
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            name="teknisi_id[]" 
                                            value="{{ $item->id }}" 
                                            id="teknisi{{ $item->id }}"
                                        >
                                        <label class="form-check-label" for="teknisi{{ $item->id }}">
                                            {{ $item->nama_teknisi }}
                                        </label>
                                    </div>
                                @empty
                                    <p>Tidak ada teknisi.</p>
                                @endforelse
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" name="action" value="simpan" class="btn btn-primary">Simpan Perubahan</button>
                                <button type="submit" name="action" value="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus teknisi yang dipilih?')">Hapus</button>
                            </div>
                        </form>
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>