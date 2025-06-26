@props([
    'daftek', 
    'propsTeknisi',
    'dafjabatan', 
    'propsJabatan', 
    'dafkategori', 
    'propsKategori', 
    'showEditButton'
    ])

<div class="datapelapor">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        {{-- Kolom NIP --}}
        <div>
            <label for="nip" class="block font-medium">
                NIP*
            </label>
            <input 
                type="number" 
                id="nip" name="nip" 
                class="w-full border border-gray-300 rounded px-3 py-2"
                required
            >
        </div>

        {{-- Kolom NIK --}}
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

        {{-- Kolom Nama Pelapor --}}
        <div class="mb-4">
            <label for="nama_pelapor" class="block font-medium">Nama Pelapor</label>
            <input 
                type="text" 
                name="nama_pelapor" 
                id="nama_pelapor"
                value="{{ Auth::user()->name }}" 
                class="w-full border border-gray-300 rounded px-3 py-2 bg-gray-100"
                readonly
            >
        </div>

        {{-- Kolom Jabatan --}}
        <div>
            <label for="kategori" class="block font-medium">Jabatan*</label>
            <div class="flex flex-row items-center justify-between gap-2">
                <select 
                    type="text" 
                    id="jabatan"
                    name="jabatan"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                >
                    <option></option>
                    @forelse($dafjabatan as $item)
                        <option>{{ $item->nama_jabatan }}</option>
                        @empty
                        <p disabled>Tidak ada Jabatan.</p>
                    @endforelse
                </select>
                
                <!-- Button Edit Teknisi -->
                @if ($showEditButton)
                <div class="flex gap-2">
                    <x-heroicon-c-pencil-square 
                        type="button" 
                        data-bs-toggle="modal" 
                        data-bs-target="{{ $propsJabatan }}" 
                        class="w-6"
                    />
                </div>
                @endif
            </div>
        </div>
        
        {{-- Kolom Kategori --}}
        <div>
            <label for="kategori" class="block font-medium">Kategori*</label>
            <div class="flex flex-row items-center justify-between gap-2">
                <select 
                    type="text" 
                    id="kategori"
                    name="kategori"
                    class="w-full border border-gray-300 rounded px-3 py-2"
                    required
                >
                    <option></option>
                    @forelse($dafkategori as $item)
                        <option>{{ $item->nama_kategori }}</option>
                        @empty
                        <p disabled>Tidak ada kategori.</p>
                    @endforelse
                </select>
                
                <!-- Button Edit Teknisi -->
                @if ($showEditButton)
                <div class="flex gap-2">
                    <x-heroicon-c-pencil-square 
                        type="button" 
                        data-bs-toggle="modal" 
                        data-bs-target="{{ $propsKategori }}" 
                        class="w-6"
                    />
                </div>
                @endif
            </div>
        </div>

        {{-- Kolom Teknisi --}}
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
                        <p disabled>Tidak ada teknisi.</p>
                    @endforelse
                </select>
                
                <!-- Button Edit Teknisi -->
                @if ($showEditButton)
                <div class="flex gap-2">
                    <x-heroicon-c-pencil-square 
                        type="button" 
                        data-bs-toggle="modal" 
                        data-bs-target="{{ $propsTeknisi }}" 
                        class="w-6"
                    />
                </div>
                @endif
            </div>
        </div>
        
        {{-- Kolom Nota Dinas --}}
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

        {{-- Kolom Tenggat Waktu --}}
        <div>
            <label for="deadline" class="block font-medium">
                Tenggat Waktu*
            </label>
            <input 
                type="date" 
                id="deadline" 
                name="deadline"
                class="w-full border border-gray-300 rounded px-3 py-2"
                required
            >
        </div>
    </div>
</div>