
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editForm">
      @csrf
      @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Pinjam</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit_id" name="id">

          <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="text" name="tanggal_pinjam" id="edit_tanggal_pinjam" class="form-control">
          </div>

          <div class="mb-3">
            <label>Tanggal Kembali</label>
            <input type="text" name="tanggal_kembali" id="edit_tanggal_kembali" class="form-control">
          </div>

          <div class="mb-3">
            <label>Status Pengembalian</label>
            <input type="text" name="status_pengembalian" id="edit_status_pengembalian" class="form-control">
          </div>

          <div class="mb-3">
            <label>Anggota ID</label>
            <input type="text" name="anggota_id" id="edit_anggota_id" class="form-control">
          </div>

          <div class="mb-3">
            <label>Buku ID</label>
            <input type="text" name="buku_id" id="edit_buku_id" class="form-control">
          </div>

          <div class="mb-3">
            <label>Kategori ID</label>
            <input type="text" name="kategori_id" id="edit_kategori_id" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>


<!-- <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{route('peminjaman.store')}}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Peminjaman</h1>
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

</div> -->