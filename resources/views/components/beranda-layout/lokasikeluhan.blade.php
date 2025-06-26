@props(['dafsatuankerja', 'daflantai', 'showEditButton'])

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
                <option></option>
                @forelse($dafsatuankerja as $item)
                    <option>{{ $item->nama_satuankerja }}</option>
                @empty
                    <option disabled>Tidak ada Satuan Kerja.</option>
                @endforelse
            </select>
            <div class="flex gap-2">
                @if ($showEditButton)
                <x-heroicon-c-pencil-square 
                    type="button" 
                    data-bs-toggle="modal" 
                    data-bs-target="#ubahSatuanKerja" 
                    class="w-6"
                />
                @endif
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
                required
            >
                <option></option>
                @forelse($daflantai as $item)
                    <option>{{ $item->nama_lantai }}</option>
                @empty
                    <option disabled>Tidak ada Lantai.</option>
                @endforelse
            </select>
            <div class="flex gap-2">
                @if ($showEditButton)
                <x-heroicon-c-pencil-square 
                    type="button" 
                    data-bs-toggle="modal" 
                    data-bs-target="#ubahLantai" 
                    class="w-6"
                />
                @endif
            </div>
        </div>
    </div>
</div>