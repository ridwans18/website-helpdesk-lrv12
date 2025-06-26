@props(['daftek', 'dafjabatan', 'dafkategori', 'dafsatuankerja', 'daflantai'])

<!-- Modal Teknisi -->
<div class="modal fade" id="ubahTeknisi" tabindex="-1" aria-labelledby="ubahTeknisiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ubahTeknisiLabel">Tambah/Hapus Nama Teknisi</h5>
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

<!-- Modal Jabatan -->
<div class="modal fade" id="ubahJabatan" tabindex="-1" aria-labelledby="ubahJabatanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('TambahJabatan.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahJabatanLabel">Tambah/Hapus Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Tambah -->
                    <div class="mb-3">
                        <h6>Tambah Jabatan</h6>
                        <input type="text" class="form-control" name="nama_jabatan" placeholder="Masukkan nama jabatan">
                    </div>

                    <!-- Checklist -->
                    <h6>Jabatan yang Ada</h6>
                    @forelse($dafjabatan as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="jabatan{{ $item->id }}" name="jabatan_id[]" value="{{ $item->id }}">
                            <label class="form-check-label" for="jabatan{{ $item->id }}">{{ $item->nama_jabatan }}</label>
                        </div>
                    @empty
                        <p>Tidak ada kategori.</p>
                    @endforelse
                </div>

                <div class="modal-footer">
                    <button type="submit" name="action" value="simpan" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="submit" name="action" value="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus satuan kerja yang dipilih?')">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Kategori -->
<div class="modal fade" id="ubahKategori" tabindex="-1" aria-labelledby="ubahKategoriLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('TambahKategori.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahKategoriLabel">Tambah/Hapus Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Tambah -->
                    <div class="mb-3">
                        <h6>Tambah Kategori</h6>
                        <input type="text" class="form-control" name="nama_kategori" placeholder="Masukkan nama kategori">
                    </div>

                    <!-- Checklist -->
                    <h6>Kategori yang Ada</h6>
                    @forelse($dafkategori as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="kategori{{ $item->id }}" name="kategori_id[]" value="{{ $item->id }}">
                            <label class="form-check-label" for="kategori{{ $item->id }}">{{ $item->nama_kategori }}</label>
                        </div>
                    @empty
                        <p>Tidak ada kategori.</p>
                    @endforelse
                </div>

                <div class="modal-footer">
                    <button type="submit" name="action" value="simpan" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="submit" name="action" value="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus satuan kerja yang dipilih?')">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Satuan Kerja -->
<div class="modal fade" id="ubahSatuanKerja" tabindex="-1" aria-labelledby="ubahSatuanKerjaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('TambahSatuanKerja.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahSatuanKerjaLabel">Tambah/Hapus Satuan Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Tambah -->
                    <div class="mb-3">
                        <h6>Tambah Satuan Kerja</h6>
                        <input type="text" class="form-control" name="nama_satuankerja" placeholder="Masukkan nama satuan kerja">
                    </div>

                    <!-- Checklist -->
                    <h6>Satuan Kerja yang Ada</h6>
                    @forelse($dafsatuankerja as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="satuan{{ $item->id }}" name="satuan_id[]" value="{{ $item->id }}">
                            <label class="form-check-label" for="satuan{{ $item->id }}">{{ $item->nama_satuankerja }}</label>
                        </div>
                    @empty
                        <p>Tidak ada satuan kerja.</p>
                    @endforelse
                </div>

                <div class="modal-footer">
                    <button type="submit" name="action" value="simpan" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="submit" name="action" value="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus satuan kerja yang dipilih?')">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Lantai -->
<div class="modal fade" id="ubahLantai" tabindex="-1" aria-labelledby="ubahLantaiLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('TambahLantai.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="ubahLantaiLabel">Tambah/Hapus Lantai</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <!-- Tambah -->
                    <div class="mb-3">
                        <h6>Tambah Lantai</h6>
                        <input type="text" class="form-control" name="nama_lantai" placeholder="Masukkan nama lantai">
                    </div>

                    <!-- Checklist -->
                    <h6>Lantai yang Ada</h6>
                    @forelse($daflantai as $item)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="lantai{{ $item->id }}" name="lantai_id[]" value="{{ $item->id }}">
                            <label class="form-check-label" for="lantai{{ $item->id }}">{{ $item->nama_lantai }}</label>
                        </div>
                    @empty
                        <p>Tidak ada lantai.</p>
                    @endforelse
                </div>

                <div class="modal-footer">
                    <button type="submit" name="action" value="simpan" class="btn btn-primary">Simpan Perubahan</button>
                    <button type="submit" name="action" value="hapus" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus lantai yang dipilih?')">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>