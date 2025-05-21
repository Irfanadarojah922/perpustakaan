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
                        <label>NIK</label>
                        <input type="text" name="id" id="edit_nik" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Nama Anggota</label>
                        <select name="pinjam_id" id="edit_nama_anggota" class="form-control" required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Judul Buku</label>
                        <select name="buku_id" id="edit_judul_buku" class="form-control" required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" id="edit_tanggal_kembali" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Denda</label>
                        <select name="denda" id="edit_denda" class="form-control" required>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Keterangan</label>
                        <select name="keterangan" id="edit_keterangan" class="form-control" required>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>

            </div>
        </form>      
    </div>
</div>