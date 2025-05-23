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
             <label>Nama Anggota</label>
             {{-- <input type="text" name="anggota_id" id="edit_anggota_id" class="form-control"> --}}
            <select name="anggota_id" id="edit_anggota_id" class="form-control" required>
              
            </select>
          </div>

          <div class="mb-3">
            <label>Judul Buku</label>
            {{-- <input type="text" name="buku_id" id="edit_buku_id" class="form-control"> --}}
            <select name="buku_id" id="edit_buku_id" class="form-control" required>
            </select>
          </div>

          <div class="mb-3">
            <label>Kategori Buku</label>
            {{-- <input type="text" name="kategori_id" id="edit_kategori_id" class="form-control"> --}}
            <select name="kategori_id" id="edit_kategori_id" class="form-control" required>
            </select>
          </div>

          <div class="mb-3">
            <label>Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" id="edit_tanggal_pinjam" class="form-control">
          </div>

          <div class="mb-3">
            <label>Tanggal Harus Kembali</label>
            <input type="date" name="tanggal_kembali" id="edit_tanggal_kembali" class="form-control">
          </div>

          {{-- <div class="mb-3">
            <label>Status Pengembalian</label>
            <select name="status_pengembalian" id="edit_status_pengembalian" class="form-control" required>
            </select>
          </div> --}}

        </div>
        
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>
