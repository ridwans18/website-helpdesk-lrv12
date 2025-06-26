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

                @if ($errors->has('form'))
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                        <ul class="list-disc pl-4">
                            <li>{{ $errors->first('form') }}</li>
                        </ul>
                    </div>
                @endif

                <!-- Report Information -->
                <form action="{{ route('keluhan.update', $datakel->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- Quick Report -->
                    <div class="mb-4">
                        <input 
                            type="text" 
                            id="keluhan" 
                            name="keluhan" 
                            maxlength="100"
                            value="{{ old('keluhan',$datakel->keluhan) }}" 
                            class="w-full border border-gray-300 rounded px-4 py-2" 
                            placeholder="Keluhan"
                        >

                        @error('keluhan')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
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
                                oninput="this.value = this.value.slice(0, 19)"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            />
                        </div>
                        <div>
                            <label for="nik" class="block font-medium">NIK</label>
                            <input 
                                type="number" 
                                id="nik" name="nik" 
                                value="{{ $datakel->nik }}"
                                oninput="this.value = this.value.slice(0, 19)"
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
                                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                                readonly
                            >
                        </div>
                        <div>
                            <label for="jabatan" class="block font-medium">Jabatan*</label>
                            <select 
                                type="text" 
                                id="jabatan"
                                name="jabatan"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                required
                            >
                                <option>{{ $datakel->jabatan }}</option>
                                @forelse($dafjabatan as $item)
                                    <option>{{ $item->nama_jabatan }}</option>
                                @empty
                                    <option disabled>Tidak ada Satuan Kerja.</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label for="kategori" class="block font-medium">Kategori*</label>
                            <select 
                                type="text" 
                                id="kategori"
                                name="kategori"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                required
                            >
                                <option>{{ $datakel->kategori }}</option>
                                @forelse($dafkategori as $item)
                                    <option>{{ $item->nama_kategori }}</option>
                                @empty
                                    <option disabled>Tidak ada Satuan Kerja.</option>
                                @endforelse
                            </select>
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
                            </div>
                        </div>
                        <div>
                            <label for="notadinas" class="block font-medium">Nota Dinas</label>
                            <input 
                                type="text" 
                                id="notadinas" 
                                name="notadinas"
                                value="{{ $datakel->notadinas }}"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                        <div>
                            <label for="tenggatwaktu" class="block font-medium">Tenggat Waktu*</label>
                            <input                 
                                type="date" 
                                id="deadline" 
                                name="deadline"
                                value="{{ $datakel->deadline ? \Carbon\Carbon::parse($datakel->deadline)->format('Y-m-d') : '' }}"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                            >
                        </div>
                    </div>

                    <!-- Location Information -->
                    <h4 class="text-lg font-semibold mb-2">Lokasi</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="region" class="block font-medium">Satuan Kerja*</label>
                            <select 
                                type="text" 
                                id="satuankerja"
                                name="satuankerja"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                required
                            >
                                <option>{{ $datakel->satuankerja }}</option>
                                @forelse($dafsatuankerja as $item)
                                    <option>{{ $item->nama_satuankerja }}</option>
                                @empty
                                    <option disabled>Tidak ada Satuan Kerja.</option>
                                @endforelse
                            </select>
                        </div>
                        <div>
                            <label for="state" class="block font-medium">Lantai</label>
                            <select 
                                type="text" 
                                id="lantai"
                                name="lantai"
                                class="w-full border border-gray-300 rounded px-3 py-2"
                                required
                            >
                                <option>{{ $datakel->lantai }}</option>
                                @forelse($daflantai as $item)
                                    <option>{{ $item->nama_lantai }}</option>
                                @empty
                                    <option disabled>Tidak ada Lantai.</option>
                                @endforelse
                            </select>
                        </div>
                    </div>

                    <!-- Extended Information -->
                    <h4 class="text-lg font-semibold mb-2">Rincian</h4>
                    <div class="mb-6">
                        <textarea 
                            id="rincian" 
                            name="rincian"
                            rows="4" 
                            maxlength="1000"
                            value="{{ $datakel->rincian }}"
                            class="w-full border border-gray-300 rounded px-3 py-2" 
                            placeholder="Tambahan?">{{ $datakel->rincian }}</textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="text-end">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-2" type="submit">Simpan</button>
                        <a href="{{ route('keluhan.berlangsung') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Batal</a>
                    </div>
                </form>
            </div>
        </main>

        <x-footer />
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</html>