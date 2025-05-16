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
            <nav class="bg-gray-800" x-data="{ isOpen: false }">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="shrink-0">
                    <img class="size-8" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </div>
                    <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Home</a>
                        <a href="beranda" class="rounded-md bg-gray-900 px-3 py-2 text-sm font-medium text-white" aria-current="page">Beranda</a>
                        <a href="daftarkeluhan" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Daftar Keluhan</a>
                        <a href="#" class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Laporan</a>
                    </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                    <button type="button" class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                        <span class="absolute -inset-1.5"></span>
                        <span class="sr-only">View notifications</span>
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </button>
        
                    <!-- Profile dropdown -->
                    <div class="relative ml-3">
                        <div>
                        <button type="button" @click="isOpen = !isOpen" class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <span class="absolute -inset-1.5"></span>
                            <span class="sr-only">Open user menu</span>
                            <img class="size-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                        </button>
                        </div>
        
                        <div 
                            x-show="isOpen"
                            x-transition:enter="transition ease-out duration-100 transform"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75 transform"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                        <!-- Active: "bg-gray-100 outline-hidden", Not Active: "" -->
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Your Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-1">Settings</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">Sign out</a>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button type="button" @click="isOpen = !isOpen" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    </button>
                </div>
                </div>
            </div>
        
            <!-- Mobile menu, show/hide based on menu state. -->
            <div x-show="isOpen" class="md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Home</a>
                <a href="beranda" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Beranda</a>
                <a href="daftarkeluhan" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Daftar Keluhan</a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Laporan</a>
                </div>
                <div class="border-t border-gray-700 pt-4 pb-3">
                <div class="flex items-center px-5">
                    <div class="shrink-0">
                    <img class="size-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
                    </div>
                    <div class="ml-3">
                    <div class="text-base/5 font-medium text-white">Tom Cook</div>
                    <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                    </div>
                    <button type="button" class="relative ml-auto shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 focus:outline-hidden">
                    <span class="absolute -inset-1.5"></span>
                    <span class="sr-only">View notifications</span>
                    <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                    </svg>
                    </button>
                </div>
                <div class="mt-3 space-y-1 px-2">
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                    <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
                </div>
                </div>
            </div>
                    
            <!-- Mobile menu -->
            <div id="mobile-menu" class="lg:hidden hidden px-4 pb-4">
                <a class="block text-gray-700 py-2" href="#">Home</a>
                <a class="block text-blue-600 font-semibold py-2" href="index.html">Beranda</a>
                <a class="block text-gray-700 py-2" href="daftarkeluhan.html">Daftar Keluhan</a>
                <a class="block text-gray-700 py-2" href="#">Laporan</a>
            </div>
            </nav>
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
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="nip" class="block font-medium">
                                NIP*
                            </label>
                            <input 
                                type="number" 
                                id="nip" name="nip" 
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="nik" class="block font-medium">
                                NIK
                            </label>
                            <input 
                                type="number" 
                                id="nik" 
                                name="nik" 
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="nama_pelapor" class="block font-medium">
                                Nama Pelapor*
                            </label>
                            <input 
                                type="text" 
                                id="nama_pelapor" 
                                name="nama_pelapor" 
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                required
                            >
                        </div>
                        <div>
                            <label for="jabatan" class="block font-medium">
                                Jabatan*
                            </label>
                            <input 
                                type="text" 
                                id="jabatan" 
                                name="jabatan" 
                                class="w-full border border-gray-300 rounded px-3 py-2" 
                                required
                            >
                        </div>
                        <div>
                            <label for="kategori" class="block font-medium">
                                Kategori*
                            </label>
                            <input 
                                type="text" 
                                id="kategori" 
                                name="kategori" 
                                class="w-full border border-gray-300 rounded px-3 py-2" 
                                required
                            >
                        </div>
                        <div>
                            <label for="teknisi" class="block font-medium">Teknisi*</label>
                            <div class="flex flex-row items-center justify-between gap-2">
                                <select 
                                    type="text" 
                                    id="teknisi"
                                    name="teknisi"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    required
                                >
                                    <option></option>
                                    @forelse($daftek as $item)
                                        <option>{{ $item->nama_teknisi }}</option>
                                        @empty
                                        <p>Tidak ada teknisi.</p>
                                    @endforelse
                                </select>
                                
                                <!-- Button Edit Teknisi -->
                                    <div class="flex gap-2">
                                        <x-heroicon-c-pencil-square 
                                            type="button" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#ubahTeknisi" 
                                            class="w-10"
                                        />
                                    </div>
                            </div>
                        </div>
                        <div>
                            <label for="notadinas" class="block font-medium">
                                Nota Dinas
                            </label>
                            <input 
                                type="text" 
                                id="notadinas" 
                                name="notadinas"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                    </div>
                

                    <!-- Schedule Report -->
                    <h4 class="text-lg font-semibold mb-2">
                        Jadwal Pelaporan
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="tanggallapor" class="block font-medium">
                                Tanggal Lapor*
                            </label>
                            <input 
                                type="date" 
                                id="tanggallapor" 
                                name="tanggallapor"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="tenggatwaktu" class="block font-medium">
                                Tenggat Waktu*
                            </label>
                            <input 
                                type="date" 
                                id="tenggatwaktu" 
                                name="tenggatwaktu"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                    </div>

                    <!-- Location Information -->
                    <h4 class="text-lg font-semibold mb-2">
                        Lokasi
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="region" class="block font-medium">
                                Satuan Kerja*
                            </label>
                            <div class="flex flex-row items-center justify-between gap-2">
                                <select 
                                    type="text"
                                    id="satuankerja" 
                                    name="satuankerja"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                    required
                                >
                                    <option>Tata Keloka TIK</option>
                                    <option>Tata Usaha</option>
                                    <option>Pengembangan</option>
                                    <option>Operasional</option>
                                </select>
                                <div class="flex gap-2">
                                    <x-heroicon-c-pencil-square 
                                        type="button" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ubahLantaiModal" 
                                        class="w-10"
                                    />
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="state" class="block font-medium">
                                Lantai
                            </label>
                            <div class="flex flex-row items-center justify-between gap-2">
                                <select 
                                    type="text"
                                    id="lantai" 
                                    name="lantai"
                                    class="w-full border border-gray-300 rounded px-3 py-2"
                                >
                                    <option>Lt.1</option>
                                    <option>Lt.2</option>
                                    <option>Lt.3</option>
                                    <option>Lt.4</option>
                                </select>
                                <div class="flex gap-2">
                                    <x-heroicon-c-pencil-square 
                                        type="button" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ubahLantaiModal" 
                                        class="w-10"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Extended Information -->
                    <h4 class="text-lg font-semibold mb-2">
                        Rincian
                    </h4>
                    <div class="mb-6">
                        <textarea 
                            id="deskripsi" 
                            name="deskripsi"
                            rows="4" 
                            class="w-full border border-gray-300 rounded px-3 py-2" 
                            placeholder="Tambahan?"></textarea>
                    </div>

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

        <!-- Script for toggle mobile menu -->
        <script>
            document.getElementById('menu-toggle').addEventListener('click', function () {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            });
        </script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>