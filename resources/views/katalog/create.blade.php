<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="" method="POST" action="{{route('book.store')}}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Buku</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="string" class="form-control" id="judul" name="judul" value="">
                    </div>
                    <div class="mb-3">
                        <label for="penulis" class="form-label">Penulis</label>
                        <input type="string" class="form-control" id="penulis" name="penulis" value="">
                    </div>
                    <div class="mb-3">
                        <label for="penerbit" class="form-label">Penerbit</label>
                        <input type="string" class="form-control" id="penerbit" name="penerbit" value="">
                    </div>
                    <div class="mb-3">
                        <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                        <input type="date" class="form-control" id="tahun_terbit" name="tahun_terbit" value="">
                    </div>
                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori ID</label>
                        <input type="string" class="form-control" id="kategori_id" name="kategori_id" value="">
                    </div>
                    <div class="mb-3">
                        <label for="isbn" class="form-label">ISBN</label>
                        <input type="string" class="form-control" id="isbn" name="isbn" value="">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_eksemplar" class="form-label">Jumlah Eksemplar</label>
                        <input type="string" class="form-control" id="jumlah_eksemplar" name="jumlah_eksemplar" value="">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_tersedia" class="form-label">Jumlah Tersedia</label>
                        <input type="string" class="form-control" id="jumlah_tersedia" name="jumlah_tersedia" value="">
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <input type="string" class="form-control" id="deskripsi" name="deskripsi" value="">
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="string" class="form-control" id="foto" name="foto" value="">
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