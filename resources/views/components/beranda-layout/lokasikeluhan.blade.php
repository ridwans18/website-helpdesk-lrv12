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
                    class="w-6"
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
                    class="w-6"
                />
            </div>
        </div>
    </div>
</div>