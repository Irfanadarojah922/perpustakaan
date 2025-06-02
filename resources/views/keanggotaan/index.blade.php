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
    <style>
        .header {
            padding: 15px;
        }

        .col {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left h1 {
            margin: 0;
        }

        .right {
            display: flex;
            gap: 10px;
        }

        .download {
            height: 36px;
            padding: 0 15px;
            border-radius: 36px;
            background: var(--primary);
            color: var(--light);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-weight: 500;
            text-decoration: none;
        }
    </style>

    <div class="header">
        <div class="col">
            <div class="left">
                <h1> @yield ("header") </h1>
                {{-- <ul class="breadcrumb">
                    <li><a href="#"> Dashboard </a></li>
                    /
                </ul> --}}
            </div>
        </div>
    </div>

    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header align-items-center d-flex mb-2">
                <h4 class="card-title  mb-0 flex-grow-1">Tabel Keanggotaan</h4>
                <div class="flex-shrink-0 mx-2">
                    <a href="" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <i class="bx bx-plus" style="font-size:1rem;"></i>
                        Add
                    </a>
                </div>
            </div>

            <div class="card-body">
               <div class="table-responsive">
                 <table id="table_anggota" class="table table-sm table-bordered table-striped" style="width:100%; white-space: nowrap;">
                    <thead>
                        <tr class="text-center">
                            <th scope="col">NIK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Tempat Lahir</th>
                            <th scope="col">Tanggal Lahir</th>
                            <th scope="col">Jenis Kelamin</th>
                            <th scope="col">Pendidikan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Daftar</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="9" class="text-center">No Data Display</td>
                        </tr>
                    </tbody>
                </table>
               </div>
            </div>
        </div>
    </div>
    @include('keanggotaan.create')
    @include('keanggotaan.edit')
    @include('keanggotaan.delete')
    {{-- @include('keanggotaan.show') --}}
   

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
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{url()->current()}}',
                columns: [
                    { data: 'nik', name: 'anggota_nik' }, 
                    { data: 'nama', name: 'nama' },
                    { data: 'tempat_lahir', name: 'tempat_lahir' },
                    { data: 'tanggal_lahir', name: 'tanggal_lahir' },
                    { data: 'jenis_kelamin', name: 'jenis_kelamin' },
                    { data: 'pendidikan', name: 'pendidikan' },
                    { data: 'alamat', name: 'alamat' },
                    { data: 'no_telepon', name: 'no_telepon' },
                    { data: 'status', name: 'status' },
                    { data: 'tanggal_daftar', name: 'tanggal_daftar' },
                    { data: 'action', name: 'action' }
                ],
                columnDefs: [
                    { targets: [0, 3], className: 'dt-left'}
                ]
            });


            //untuk validasi nomor telepon harus diawali +62
            $(document).on('input', '#no_telepon', function () {
                let value = $(this).val();
                if (!value.startsWith('+62')) {
                    $('#no_telp_error').text('Nomor telepon harus diawali dengan +62').show();
                } else {
                    $('#no_telp_error').hide();
                }
            });


            // utk input pengembalian
            $.get(`/keanggotaan/add`, function(res) {
                let data = res.data;

                    $('#nik').val(data.nik);
                    $('#nama').val(data.nama);
                    $('#tempat_lahir').val(data.tempat_lahir);
                    $('#tanggal_lahir').val(data.tanggal_lahir);
                    $('#jenis_kelamin').val(data.jenis_kelamin);
                    $('#pendidikan').val(data.pendidikan);
                    $('#alamat').val(data.alamat);
                    $('#no_telepon').val(data.no_telepon);
                    $('#status').val(data.status);
                    $('#tanggal_daftar').val(data.tanggal_daftar);
            });




            //delete
            $(document).on('click', '.deleteBtn', function () {
                let id = $(this).data('id');
                $('#delete_id').val(id);
                $('#deleteModal').modal('show');
            });

            $('#deleteForm').submit(function (e) {
                e.preventDefault();
                let id = $('#delete_id').val();

                $.ajax({
                url: `/keanggotaan/${id}`,
                type: 'POST',
                data: {
                _method: 'DELETE',
                _token: '{{ csrf_token() }}'
                },
                success: function (res) {
                    $('#deleteModal').modal('hide');
                    $('#table_anggota').DataTable().ajax.reload();
                    alert(res.message);
                    },
                    error: function (err) {
                    alert('Terjadi kesalahan saat menghapus.');
                    console.log(err.responseText);
                    }
                });
            });

        });


        //show kartu anggota
            function detail_anggota(id) {
                let url = '{{ route("keanggotaan.show", ":id") }}';
                url = url.replace(':id', id);
                window.open(url);
            }


    </script>
@endpush