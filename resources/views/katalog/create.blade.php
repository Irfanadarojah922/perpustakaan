<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="createModalLabel">Input Buku</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <!-- Kode Buku -->
          <div class="mb-3">
            <label for="kode_buku" class="form-label">Kode Buku</label>
            <input type="text" class="form-control @error('kode_buku') is-invalid @enderror" id="kode_buku" name="kode_buku" value="{{ old('kode_buku') }}" required placeholder="Masukkan kode buku">
            @error('kode_buku')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Judul -->
          <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul') }}" required placeholder="Masukkan judul buku">
            @error('judul')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Penulis -->
          <div class="mb-3">
            <label for="penulis" class="form-label">Penulis</label>
            <input type="text" class="form-control @error('penulis') is-invalid @enderror" id="penulis" name="penulis" value="{{ old('penulis') }}" required placeholder="Masukkan nama penulis">
            @error('penulis')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Penerbit -->
          <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control @error('penerbit') is-invalid @enderror" id="penerbit" name="penerbit" value="{{ old('penerbit') }}" required placeholder="Masukkan nama penerbit">
            @error('penerbit')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Tahun Terbit -->
          <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control @error('tahun_terbit') is-invalid @enderror" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit') }}" required placeholder="Masukkan tahun terbit">
            @error('tahun_terbit')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Kategori -->
          <div class="mb-3">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
              <option value="" disabled selected>Pilih Kategori</option>
              @foreach ($kategoris as $kategori)
                <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                  {{ $kategori->nama_kategori }}
                </option>
              @endforeach
            </select>
            @error('kategori_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- ISBN -->
          <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}" required placeholder="Masukkan ISBN">
            @error('isbn')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Jumlah Eksemplar -->
          <div class="mb-3">
            <label for="jumlah_eksemplar" class="form-label">Jumlah Eksemplar</label>
            <input type="number" class="form-control @error('jumlah_eksemplar') is-invalid @enderror" id="jumlah_eksemplar" name="jumlah_eksemplar" value="{{ old('jumlah_eksemplar') }}" required placeholder="Masukkan jumlah kesemplar">
            @error('jumlah_eksemplar')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Jumlah Tersedia -->
          <div class="mb-3">
            <label for="jumlah_tersedia" class="form-label">Jumlah Tersedia</label>
            <input type="number" class="form-control @error('jumlah_tersedia') is-invalid @enderror" id="jumlah_tersedia" name="jumlah_tersedia" value="{{ old('jumlah_tersedia') }}" required placeholder="Masukkan jumlah tersedia">
            @error('jumlah_tersedia')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Deskripsi -->
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" required placeholder="Masukkan deskripsi buku">
              {{ old('deskripsi') }}
            </textarea>
            @error('deskripsi')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Foto -->
          <div class="mb-3">
            <label for="foto" class="form-label">Foto</label>
            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto" required placeholder="Upload Foto sampul buku">
            @error('foto')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
