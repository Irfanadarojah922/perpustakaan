<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('keanggotaan.store') }}">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Input Anggota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="anggota_nik" class="form-label">NIK</label>
                        <input type="char" class="form-control @error('nik') is-invalid
                        @enderror" id="nik" name="nik" value="{{ old('nik') }}">
                        @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('nama') is-invalid
                        @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                        @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control @error('tempat_lahir') is-invalid
                        @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}">
                        @error('tempat_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid
                        @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control @error('jenis_kelamin') is-invalid
                        @enderror" name="jenis_kelamin" id="jenis_kelamin" value="{{ old('jenis_kelamin') }}">
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                            <option value="">- Pilih Jenis Kelamin -</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan</label>
                        <select class="form-control @error('pendidikan') is-invalid
                        @enderror" name="pendidikan" id="pendidikan" value="{{ old('pendidikan') }}">
                        @error('pendidikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            <option value="">- Pilih Pendidikan -</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="Sarjana">Sarjana</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('judul') is-invalid
                        @enderror" id="alamat" name="alamat" value="{{ old('alamat') }}">
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">No. Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon" class="form-control" required>
                        <small id="no_telp_error" style="color: red; display: none;"></small>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid
                        @enderror" name="status" id="status" value="{{ old('status') }}">
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            <option value="">- Pilih Status -</option>
                            <option value="pelajar">Pelajar</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="umum">Umum</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" id="foto" name="foto" value="{{ old('foto') }}">
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                        <input type="date" class="form-control @error('tanggal_daftar') is-invalid
                        @enderror" id="tanggal_daftar" name="tanggal_daftar" value="{{ old('tanggal_daftar') }}">
                        @error('tanggal_daftar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal"> Keluar </button>
                    <button type="submit" class="btn btn-primary btn-sm"> Simpan </button>
                </div>
            </form>

        </div>
    </div>
</div>