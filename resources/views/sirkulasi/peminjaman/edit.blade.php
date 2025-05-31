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
             <label>No NIK</label>
            <select name="anggota_id" id="edit_anggota_nik" class="form-control" required> 
            </select>
          </div>

          <div class="mb-3">
             <label>Nama Anggota</label>
            <select name="anggota_id" id="edit_nama" class="form-control" required> 
            </select>
          </div>

          <div class="mb-3">
            <label>Kode Buku</label>
            <select name="buku_id" id="edit_kode_buku" class="form-control" required>
            </select>
          </div>

          <div class="mb-3">
            <label>Judul Buku</label>
            <select name="buku_id" id="edit_judul" class="form-control" required>
            </select>
          </div>

          <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="edit_tanggal_pinjam" class="form-control">
          </div>

          <div class="mb-3">
            <label>Tanggal Harus Kembali</label>
            <input type="date" name="tanggal_kembali" id="edit_tanggal_harus_kembali" class="form-control">
          </div>

        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
