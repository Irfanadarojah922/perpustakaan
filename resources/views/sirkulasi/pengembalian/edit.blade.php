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
                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label>ID</label>
                        <input type="text" name="id" id="edit_id" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Pinjam ID</label>
                        {{-- <input type="text" name="pinjam_id" id="edit_pinjam_id" class="form-control"> --}}
                        <select name="pinjam_id" id="edit_pinjam_id" class="form-control" required>
                        <!-- Option akan diisi lewat JavaScript (lihat bawah) -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Buku ID</label>
                        {{-- <input type="text" name="buku_id" id="edit_buku_id" class="form-control"> --}}
                        <select name="buku_id" id="edit_buku_id" class="form-control" required>
                        <!-- Option akan diisi lewat JavaScript (lihat bawah) -->
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="edit_tanggal_kembali" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Denda</label>
                        <input type="text" name="denda" id="edit_denda" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" id="edit_keterangan" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>

            </div>
        </form>      
    </div>
</div>