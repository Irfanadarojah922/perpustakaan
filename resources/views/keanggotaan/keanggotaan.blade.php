@extends("layout.app")
@section("title", "Keanggotaan")
@section("header", "Keanggotaan")

{{-- Css Styling --}}
@push ("css-libs")
    <style>
    </style>
@endpush
@section("content")

<div class="header">
    <div class="left">
        <h1> @yield ("header") </h1>
        <ul class="breadcrumb">
            <li><a href="#">
                    Dashboard
                </a></li>
            /
        </ul>
    </div>
    <a href="#" class="report">
        <i class='bx bx-cloud-download'></i>
        <span>Download CSV</span>
    </a>
</div>

<div class="mx-auto">
    <!-- untuk memasukkan data -->
    <div class="card">
        <div class="card-header">
            Create / Edit Data
        </div>
        <div class="card-body">

            <form action="" method="POST" action="{{route('keanggotaan.store')}}">
                @csrf
                @method('post')
                <!-- <div class="mb-3 row">
                    <label for="nim" class="col-sm-2 col-form-label">Id</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="id" name="id" value="">
                    </div>
                </div> -->
                <div class="mb-3 row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="no_telepon" class="col-sm-2 col-form-label">No. Telepon</label>
                    <div class="col-sm-10">
                        <input type="telp" class="form-control" id="no_telepon" name="no_telepon" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                    <div class="col-sm-10">
                        <textarea type="text" class="form-control" id="alamat" name="alamat" value=""></textarea>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tanggal_daftar" class="col-sm-2 col-form-label">Tanggal Daftar</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" id="tanggal_daftar" name="tanggal_daftar" value="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="fakultas" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="status" id="status">
                            <option value="">- Pilih Status -</option>
                            <option value="pelajar">pelajar</option>
                            <option value="mahasiswa">mahasiswa
                            </option>
                            <option value="umum">umum</option>

                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" type="submit">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <!-- untuk mengeluarkan data -->
    <div class="card">
        <div class="card-header">
            Data Mahasiswa
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <!-- <th scope="col">Password</th> -->
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tanggal Daftar</th>
                        <th scope="col">Status</th>
                    </tr>
                    @foreach ($anggota as $key => $item)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$item->id}}</td>
                            <td>{{$item->nama}}</td>
                            <td>{{$item->email}}</td>
                            <!-- <td>{{$item->password}}</td> -->
                            <td>{{$item->no_telepon}}</td>
                            <td>{{$item->alamat}}</td>
                            <td>{{$item->tanggal_daftar}}</td>
                            <td>{{$item->status}}</td>
                        </tr>
                    @endforeach
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection