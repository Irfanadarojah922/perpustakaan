<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            {{-- <form method="POST" action="{{ route('keanggotaan.store') }}"> --}}

                <form id="formAddAnggota">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Input Anggota</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    {{-- nik --}}
                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="add_nik" name="nik" placeholder="Masukkan nik">
                    </div>


                    {{-- nama --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="add_nama" name="nama" placeholder="Masukkan nama lengkap">
                    </div>

                    
                    {{-- tempat lahir --}}
                    <div class="mb-3">
                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control" id="add_tempat_lahir" name="tempat_lahir" placeholder="Masukkan tempat lahir">
                    </div>


                    {{-- tanggal lahir --}}
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control @error('tanggal_lahir') is-invalid
                        @enderror" id="add_tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" placeholder="Masukkan tanggal lahir">
                        @error('tanggal_lahir')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- jenis kelamin --}}
                    <div class="mb-3">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <select class="form-control @error('jenis_kelamin') is-invalid
                        @enderror" name="jenis_kelamin" id="add_jenis_kelamin" value="{{ old('jenis_kelamin') }}" placeholder="Pilih jenis kelamin">
                        @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                            <option value="">- Pilih Jenis Kelamin -</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    {{-- pendidikan --}}
                    <div class="mb-3">
                        <label for="pendidikan" class="form-label">Pendidikan</label>
                        <select class="form-control @error('pendidikan') is-invalid
                        @enderror" name="pendidikan" id="add_pendidikan" value="{{ old('pendidikan') }}" placeholder="Pilih Pendidikan">
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

                    {{-- alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('judul') is-invalid
                        @enderror" id="add_alamat" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan alamat lengkap">
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </textarea>
                    </div>

                    {{-- telepon --}}
                    <div class="mb-3">
                        <label for="foto" class="form-label">No. Telepon</label>
                        <input type="text" name="no_telepon" id="add_no_telepon" class="form-control" placeholder="Masukkan no telepon">
                        <small id="no_telp_error" style="color: red; display: none;"></small>
                    </div>

                    {{-- status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control @error('status') is-invalid
                        @enderror" name="status" id="add_status" value="{{ old('status') }}" placeholder="Pilih status">
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                            <option value="">- Pilih Status -</option>
                            <option value="pelajar">Pelajar</option>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="umum">Umum</option>
                        </select>
                    </div>

                    {{-- foto --}}
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control @error('foto') is-invalid
                        @enderror" id="add_foto" name="foto" value="{{ old('foto') }}" placeholder="Masukkan foto">
                        @error('foto')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- tanggal daftar --}}
                    <div class="mb-3">
                        <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
                        <input type="date" class="form-control @error('tanggal_daftar') is-invalid
                        @enderror" id="add_tanggal_daftar" name="tanggal_daftar" value="{{ old('tanggal_daftar') }}" placeholder="Masukkan tanggal daftar">
                        @error('tanggal_daftar')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid
                        @enderror" id="add_email" name="email" value="{{ old('email') }}" placeholder="Masukkan alamat email">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- tanggal daftar --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid
                        @enderror" id="add_password" name="password" value="{{ old('password') }}" placeholder="Masukkan password">
                        @error('password')
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