@extends("layout.app")
@section("title", "Pengembalian")
@section("header", "Pengembalian")

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
    </div>

    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header align-items-center d-flex mb-2">
                <h4 class="card-title  mb-0 flex-grow-1">Tabel Pengembalian</h4>
                <div class="flex-shrink-0 mx-2">
                    <a href="" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bx bx-plus" style="font-size:1rem;"></i>
                        Add
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table id="table_pengembalian" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">ID</th>
                            <th scope="col">Pinjam ID</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Denda</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th colspan="8" class="text-center">No Data Display</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('sirkulasi.pengembalian.create')
    @include('sirkulasi.pengembalian.edit')

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                  var myModal = new bootstrap.Modal(document.getElementById('createModal'));
            myModal.show();
            })
        </script>
    @endif

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
            $('#table_pengembalian').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{url()->current()}}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'pinjam_id', name: 'pinjam_id' },
                    { data: 'bukus.judul', name: 'buku_id' },
                    { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                    { data: 'denda', name: 'denda' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'action', name: 'action' }

                ]
            })
        })
    </script>
@endpush