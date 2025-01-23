<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" action="{{route('pengembalian.store')}}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" class="form-control" id="id" name="id" value="">
                    </div>

                    <div class="mb-3">
                        <label for="pinjam_id" class="form-label">Pinjam ID</label>
                        <input type="text" class="form-control" id="pinjam_id" name="pinjam_id" value="">
                    </div>

                    <div class="mb-3">
                        <label for="buku_id" class="form-label">Buku ID</label>
                        <input type="text" class="form-control" id="buku_id" name="buku_id" value="">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali" value="">
                    </div>

                    <div class="mb-3">
                        <label for="denda" class="form-label">Denda</label>
                        <textarea type="text" class="form-control" id="denda" name="denda" value=""></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="">
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