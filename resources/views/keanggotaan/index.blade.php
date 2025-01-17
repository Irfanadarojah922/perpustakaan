@extends("layout.app")
@section("title", "Keanggotaan")
@section("header", "Keanggotaan")

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
            <table id="table_anggota" class="table table-bordered table-striped" style="width:100%">
                <thead>
                    <tr class="text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">No. Telepon</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Tanggal Daftar</th>
                        <th scope="col">Status</th>
                    </tr>
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
@include('keanggotaan.create')
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
            $('#table_anggota').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url()->current()}}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'nama', name: 'nama' },
                    { data: 'email', name: 'email' },
                    { data: 'no_telepon', name: 'no_telepon' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'tanggal_daftar', name: 'tanggal_daftar' },
                    { data: 'status', name: 'status' },
                ]
            })

        })
    </script>
@endpush