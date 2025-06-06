<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <form action="" method="POST" action="{{route('pengembalian.store')}}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Input Pengembalian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                {{-- kode buku --}}
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kode Buku</label>
                        <select name="buku_id" id="add_kode_buku" class="form-control" required>
                        </select>
                    </div>

                    {{-- tanggal lahir --}}
                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control @error('tanggal_kembali') is-invalid
                        @enderror" id="tanggal_kembali" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}">
                        @error('tanggal_kembali')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- denda --}}
                    <div class="mb-3">
                        <label for="denda" class="form-label">Denda</label>
                        <select class="form-control @error('denda') is-invalid
                        @enderror" name="denda" id="denda" value="{{ old('denda') }}">
                            @error('denda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <option value="">- Pilih -</option>
                            <option value="Ganti Buku"> Ganti Buku </option>
                            <option value="Perbaikan"> Perbaikan </option>
                            <option value="Tepat Waktu"> Tepat Waktu </option>
                        </select>
                    </div>

                    {{-- keterangan --}}
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <select class="form-control @error('keterangan') is-invalid
                        @enderror" name="keterangan" id="keterangan" value="{{ old('keterangan') }}">
                            @error('keterangan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <option value="">- Pilih -</option>
                            <option value="buku hilang"> Buku hilang </option>
                            <option value="rusak"> Rusak </option>
                            <option value="tepat waktu"> Tepat Waktu </option>
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