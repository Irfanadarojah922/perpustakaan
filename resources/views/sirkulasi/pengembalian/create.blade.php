<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" action="{{route('pengembalian.store')}}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Pengembalian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control @error('id') is-invalid
                        @enderror" id="id" name="id" value="{{ old('id') }}">
                        @error('id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Pinjam ID</label>
                        <select name="pinjam_id" id="add_pinjam_id" class="form-control" required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Judul Buku</label>
                        {{-- <input type="text" name="buku_id" id="edit_buku_id" class="form-control"> --}}
                        <select name="buku_id" id="add_buku_id" class="form-control" required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control @error('tanggal_kembali') is-invalid
                        @enderror" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}">
                        @error('tanggal_kembali')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="denda" class="form-label">Denda</label>
                        <select class="form-control @error('denda') is-invalid
                        @enderror" name="denda" id="denda" value="{{ old('denda') }}">
                        @error('denda')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                            <option value="">- Pilih -</option>
                            <option value="ganti buku"> Ganti Buku </option>
                            <option value="perbaikan Buku"> Perbaikan </option>
                            <option value="tepat waktu"> Tepat Waktu </option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <select class="form-control @error('keterangan') is-invalid
                        @enderror" name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                        @error('keterangan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                            <option value="">- Pilih -</option>
                            <option value="dipinjam"> Buku hilang </option>
                            <option value="dipinjam"> Rusak </option>
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