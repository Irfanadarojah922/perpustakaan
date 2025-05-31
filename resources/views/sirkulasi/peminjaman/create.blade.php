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
                        <label>No NIK</label>
                        <select name="anggota_id" id="add_anggota_nik" class="form-control" required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Kode Buku</label>
                        <select name="buku_id" id="add_kode_buku" class="form-control" required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control  @error('tanggal_pinjam') is-invalid
                        @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam') }}">
                        @error('tanggal_pinjam')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

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