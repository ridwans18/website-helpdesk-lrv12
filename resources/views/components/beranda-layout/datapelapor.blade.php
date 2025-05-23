@props(['daftek', 'propsTeknisi'])

<div class="datapelapor">
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
                {{-- @if(isset($user) && $user->level == 1) --}}
                    <div class="flex gap-2">
                        <x-heroicon-c-pencil-square 
                            type="button" 
                            data-bs-toggle="modal" 
                            data-bs-target="{{ $propsTeknisi }}" 
                            class="w-6"
                        />
                    </div>
                {{-- @endif --}}
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
</div>