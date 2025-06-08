<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editForm">
            @csrf
            @method('PUT')

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kembali</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div>
                        <input type="hidden" id="edit_id" name="pinjam_id" value="" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label>Kode Buku</label>
                        <select id="edit_kode_buku" class="form-control" required>
                        </select>
                    </div> -->

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
            </div>
        </form>
    </div>
</div>