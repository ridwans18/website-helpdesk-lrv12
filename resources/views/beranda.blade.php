<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
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
        @php
            $user = Auth::user();
            $navbarLinks = [
                ['href' => '/', 'text' => 'Home'],
                ['href' => 'beranda', 'class' => 'text-white bg-gray-900', 'text' => 'Beranda'],
                ['href' => route('keluhan.berlangsung'), 'text' => 'Daftar Keluhan'],
                ['href' => 'laporan', 'text' => 'Laporan'],
            ];

            if ($user && $user->level == 1) {
                $navbarLinks[] = ['href' => 'register', 'text' => 'Kelola User'];
            }
        @endphp

        <div class="min-h-full">
            <x-navbar :links="$navbarLinks" />
        </div>
        
        <main class="flex-grow container mx-auto px-4 py-6 min-h-screen">
            <!-- Start Content -->
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-semibold mb-6">Buat Laporan</h2>

                <!-- Report Information -->
                <form action="{{ route('beranda.store') }}" method="POST">
                    @csrf
                    <!-- Quick Report -->
                    <div class="mb-4">
                        <input 
                            type="text" 
                            for="keluhan" 
                            id="keluhan" 
                            name="keluhan" 
                            class="w-full border border-gray-300 rounded px-4 py-2" 
                            placeholder="Keluhan"
                            required
                        >
                    </div>
                    <!-- Grid Content -->
                    <x-beranda-layout.datapelapor 
                        :daftek="$daftek" 
                        :dafjabatan="$dafjabatan"
                        :dafkategori="$dafkategori"
                        :filters="$filters"
                        :showEditButton="$showEditButton"
                        propsTeknisi="#ubahTeknisi" 
                        propsJabatan="#ubahJabatan"
                        propsKategori="#ubahKategori"
                    />
                
                    <x-beranda-layout.lokasikeluhan 
                        :dafsatuankerja="$dafsatuankerja" 
                        :daflantai="$daflantai" 
                        :showEditButton="$showEditButton"
                    />

                    <x-beranda-layout.rinciantambahan></x-rinciantambahan>

                    <!-- Buttons -->
                    <div class="text-end">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-2" type="submit">Simpan</button>
                        <button class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Batal</button>
                    </div>
                </form>
            </div>

            <x-beranda-layout.modalsberanda 
                :daftek="$daftek" 
                :dafjabatan="$dafjabatan"
                :dafkategori="$dafkategori"
                :dafsatuankerja="$dafsatuankerja" 
                :daflantai="$daflantai"
            />
        </main>

        <x-footer />
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>