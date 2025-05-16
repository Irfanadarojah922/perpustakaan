<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('katalog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control @error('judul') is-invalid
                        @enderror" id="judul" name="judul" value="{{ old('judul') }}">
                        @error('judul')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="penulis" class="form-control  @error('penulis') is-invalid
                        @enderror" id="penulis" name="penulis" value="{{ old('penulis') }}">
                        @error('penulis')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="penerbit" class="form-control @error('penerbit') is-invalid
                        @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit') }}">
                        @error('penerbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="int" class="form-control @error('tahun_terbit') is-invalid
                        @enderror" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}">
                        @error('tahun_terbit')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select class="form-select @error('kategori_id') is-invalid
                            @enderror" id="kategori_id" name="kategori_id" value="{{ old('kategori_id') }}">
                            @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <option selected disabled>Pilih Kategori</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="text" class="form-control @error('isbn') is-invalid
                        @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}">
                        @error('isbn')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_eksemplar" class="form-label">Jumlah Eksemplar</label>
                        <input type="text" class="form-control @error('jumlah_eksemplar') is-invalid
                        @enderror" id="jumlah_eksemplar" name="jumlah_eksemplar" value="{{ old('jumlah_eksemplar') }}">
                        @error('jumlah_eksemplar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="jumlah_tersedia" class="form-label">Jumlah Tersedia</label>
                        <input type="text" class="form-control @error('jumlah_tersedia') is-invalid
                        @enderror" id="jumlah_tersedia" name="jumlah_tersedia" value="{{ old('jumlah_tersedia') }}">
                        @error('jumlah_tersedia')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control @error('deskripsi') is-invalid
                        @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
                        @error('deskripsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" id="foto" name="foto" value="{{ old('foto') }}">
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>