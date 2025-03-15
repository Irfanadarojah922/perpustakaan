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
                        <input type="string" class="form-control" id="anggota_id" name="anggota_id" value="">
                    </div>
                    <div class="mb-3">
                        <label for="buku_id" class="form-label">Buku ID</label>
                        <input type="string" class="form-control" id="buku_id" name="buku_id" value="">
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori ID</label>
                        <input type="string" class="form-control" id="kategori_id" name="kategori_id" value="">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam" value="">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="">
                    </div>
                    <div class="mb-3">
                        <label for="status_pengembalian" class="form-label">Status Pengembalian</label>
                        <select class="form-control" name="status_pengembalian" id="status_pengembalian">
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