@extends("layout.app")
@section("title", "Peminjaman")
@section("header", "Peminjaman")

{{-- Css Styling --}}
@push ("css-libs")
    <meta name="csrf_token" content="{{csrf_token()}}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
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
    <!-- untuk mengeluarkan data -->
    <div class="card">
        <div class="card-header align-items-center d-flex mb-2">
            <h4 class="card-title  mb-0 flex-grow-1">Page Items</h4>
            <div class="flex-shrink-0 mx-2">
                <a href="" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <i class="bx bx-plus" style="font-size:1rem;"></i>
                    Add
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <table id="table_peminjaman" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Tanggal Pinjam</th>
                        <th scope="col">Tanggal Kembali</th>
                        <th scope="col">Status Pengembalian</th>
                        <th scope="col">Anggota ID</th>
                        <th scope="col">Buku ID</th>
                        <th scope="col">Kategori ID</th>
                        <th scope="col">Aksi</th>
                    </tr>

                    @foreach ($pinjams as $pinjam)
                    <tr>
                        <td>{{ $pinjam->tanggal_pinjam }}</td>
                        <td>{{ $pinjam->tanggal_kembali }}</td>
                        <td>{{ $pinjam->status_peminjaman }}</td>
                        <td>{{ $pinjam->anggota_id }}</td>
                        <td>{{ $pinjam->buku_id }}</td>
                        <td>{{ $pinjam->kategori_id }}</td>

                        <td>
                            <form action="{{ route('peminjaman.store',$pinjam->id) }}" method="POST">
                                <a class="btn btn-info" href="{{ route('peminjaman.show',$product->id) }}">Show</a>
                                <a class="btn btn-primary" href="{{ route('peminjaman.edit',$product->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')                  
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </thead>
                
                <tbody>
                    <tr>
                        <th colspan="7" class="text-center">No Data Display</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@include('sirkulasi.peminjaman.create')
@endsection

@push('script-libs')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
@endpush

@push("scripts")
    <script>
        $(document).ready(function () {
            $('#table_peminjaman').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url()->current()}}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
                    { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                    { data: 'status_pengembalian', name: 'status_pengembalian' },
                    { data: 'anggotas.nama', name: 'anggota_id' },
                    { data: 'bukus.judul', name: 'buku_id' },
                    { data: 'kategoris.nama_kategori', name: 'kategori_id' },
                ]
            })
        })
    </script>
@endpush