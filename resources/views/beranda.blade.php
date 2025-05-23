<!DOCTYPE html>
<html class="h-full bg-gray-100">
    <head>
        <title>Beranda Helpdesk</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="flex flex-col min-h-screen d-flex flex-column min-vh-100">
        <div class="min-h-full">
            <x-navbar :links="[
                ['href' => '/', 'text' => 'Home'],
                ['href' => 'beranda', 'text' => 'Beranda', 'class' => 'text-white bg-gray-900'],
                ['href' => 'daftarkeluhan', 'text' => 'Daftar Keluhan'],
                ['href' => 'laporan', 'text' => 'Laporan'],
            ]" 
            />
        </div>
        
        <main class="flex-grow container mx-auto px-4 py-6">
            <!-- Start Content -->
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-semibold mb-6">Buat Laporan</h2>

                <!-- Report Information -->
                <form action="{{ route('admin.beranda.store') }}" method="POST">
                    @csrf
                    <!-- Quick Report -->
                    <div class="mb-4">
                        <input 
                        type="text" 
                        for="keluhan" 
                        id="keluhan" 
                        name="keluhan" 
                        class="w-full border border-gray-300 rounded px-4 py-2" 
                        placeholder="Keluhan">
                    </div>
                    <!-- Grid Content -->
                    <x-beranda-layout.datapelapor :daftek="$daftek" propsTeknisi="#ubahTeknisi" />
                
                    <x-beranda-layout.jadwalpelapor></x-jadwalpelapor>

                    <x-beranda-layout.lokasikeluhan></x-lokasikeluhan>

                    <x-beranda-layout.rinciantambahan></x-rinciantambahan>

                    <!-- Buttons -->
                    <div class="text-end">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-2" type="submit">Simpan</button>
                        <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Batal</button>
                    </div>
                </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="ubahTeknisi" tabindex="-1" aria-labelledby="ubahTeknisiLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ubahTeknisiLabel">Tambah/Hapus Nama Teknisi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('admin.TambahTeknisi.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <!-- Tambah teknisi baru -->
                                <div class="mb-3">
                                    <h6>Tambah Teknisi</h6>
                                    <input type="text" class="form-control" name="nama_teknisi" placeholder="Masukkan nama teknisi" required>
                                </div>

                                <!-- Checklist teknisi yang ada -->
                                <h6>Teknisi yang Ada</h6>
                                @forelse($daftek as $item)
                                    <div class="form-check">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            id="teknisi{{ $item->id }}" 
                                            name="teknisi_id[]" 
                                            value="{{ $item->id }}"
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
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>