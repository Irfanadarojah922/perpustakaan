<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" action="{{route('peminjaman.store')}}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Peminjaman</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="anggota_id" class="form-label">Anggota ID</label>
                        <input type="string" class="form-control @error('anggota_id') is-invalid
                        @enderror" id="anggota_id" name="anggota_id" value="{{ old('anggota_id') }}">
                        @error('anggota_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="buku_id" class="form-label">Buku ID</label>
                        <input type="string" class="form-control  @error('buku_id') is-invalid
                        @enderror" id="buku_id" name="buku_id" value="{{ old('buku_id') }}">
                        @error('buku_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori ID</label>
                        <input type="string" class="form-control  @error('kategori_id') is-invalid
                        @enderror" id="kategori_id" name="kategori_id" value="{{ old('kategori_id') }}">
                        @error('kategori_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control  @error('tanggal_pinjam') is-invalid
                        @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}">
                        @error('tanggal_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control  @error('tanggal_kembali') is-invalid
                        @enderror" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}">
                        @error('tanggal_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="status_pengembalian" class="form-label">Status Pengembalian</label>
                        <select class="form-control @error('status_pengembalian') is-invalid
                        @enderror" id="status_pengembalian" name="status_pengembalian" value="{{ old('status_pengembalian') }}">
                        @error('status_pengembalian')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            <option value="">- Pilih Status Pengembalian -</option>
                            <option value="dipinjam">Di Pinjam</option>
                            <option value="dikembalikan">Di Kembalikan</option>
                        </select>
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