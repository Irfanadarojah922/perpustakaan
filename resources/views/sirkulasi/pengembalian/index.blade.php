@extends("layout.app")
@section("title", "Pengembalian")
@section("header", "Pengembalian")

{{-- Css Styling --}}
@push ("css-libs")
    <meta name="csrf_token" content="{{csrf_token()}}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endpush

@section("content")

    <div class="header">
        <div class="left">
            <h1> @yield ("header") </h1>
            {{-- <ul class="breadcrumb">
                <li><a href="#">
                        Dashboard
                    </a></li>
                /
            </ul> --}}
        </div>
    </div>

    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card shadow-md">
            <div class="card-header align-items-center d-flex mb-2">
                <h4 class="card-title  mb-0 flex-grow-1">Tabel Pengembalian</h4>
                <div class="flex-shrink-0 mx-2">
                    <a href="" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#addModal">
                        <i class="bx bx-plus" style="font-size:1rem;"></i>
                        Add
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_pengembalian" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Nama Anggota</th>
                                <th scope="col">Kode Buku</th>
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
    </div>

    @include('sirkulasi.pengembalian.create')
    @include('sirkulasi.pengembalian.edit')
    @include('sirkulasi.pengembalian.delete')

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push("scripts")
    <script>
        $(document).ready(function () {

            //init select2

            $('#add_kode_buku').select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#addModal'),
                placeholder: 'Silahkan masukan kode buku...',
                ajax: {
                    url: '{{ route('search.buku.dipinjam') }}',
                    dataType: 'json',
                    delay: 250,
                    method: 'GET',
                    data: function (params) {
                        return {
                            q: params.term
                        }
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    id: item.id,
                                    text: item.bukus.kode_buku
                                }
                            })
                        }
                    }
                }
            });

            $(document).on('select2:select', function (e) {
                $("#pinjam_id").val(e.params.data.id);
            })


            $('#table_pengembalian').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{url()->current()}}',
                columns: [
                    // { data: 'id', name: 'id' },
                    // { data: 'anggota.nik', name: 'nik' }, 
                    { data: 'anggota.nama', name: 'nama' },
                    { data: 'bukus.kode_buku', name: 'buku_id' },
                    { data: 'bukus.judul', name: 'buku_id' },
                    { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                    { data: 'denda', name: 'denda' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'action', name: 'action' }
                ],
                columnDefs: [
                    { targets: [0, 3], className: 'dt-left' }
                ]
            });

            //edit
            $(document).on('click', '.editBtn', function () {
                let id = $(this).data('id');

                $.get(`/pengembalian/${id}/edit`, function (res) {
                    let data = res.data;

                    $('#edit_tanggal_kembali').val(data.tanggal_kembali);
                    $('#edit_denda').val(data.denda);
                    $('#edit_keterangan').val(data.keterangan);


                    // Populate anggota
                    let anggotaOptions = ``;
                    res.anggotas.forEach(function (anggota) {
                        // console.log(anggota.id);
                        anggotaOptions += `<option value="${anggota.id}" ${anggota.id == data.anggota_id ? 'selected' : ''}>${anggota.nama}</option>`;
                    });
                    $('#edit_nama_anggota').html(anggotaOptions);

                    // Populate buku
                    let bukuOptions = '';
                    res.bukus.forEach(function (buku) {
                        bukuOptions += `<option value="${buku.id}" ${buku.id == data.buku_id ? 'selected' : ''}>${buku.kode_buku}</option>`;
                    });
                    $('#edit_kode_buku').html(bukuOptions);

                    let judulOptions = '';
                    res.bukus.forEach(function (buku) {
                        judulOptions += `<option value="${buku.id}" ${buku.id == data.buku_id ? 'selected' : ''}>${buku.judul}</option>`;
                    });
                    $('#edit_judul_buku').html(judulOptions);

                    $('#editModal').modal('show');
                });


                $('#editForm').submit(function (e) {
                    e.preventDefault();
                    let id = $('#edit_id').val();
                    $.ajax({

                        url: `/pengembalian/${id}`,
                        method: 'PUT',
                        data: $(this).serialize(),
                        success: function (res) {
                            $('#editModal').modal('hide');
                            $('#table_pengembalian').DataTable().ajax.reload();
                            alert('Data berhasil diupdate!');
                        },
                        error: function (err) {
                            alert('Terjadi kesalahan saat mengupdate.');
                            console.log(err.responseJSON);
                        }
                    });
                });
            });

            $(document).on('click', '.deleteBtn', function () {
                let id = $(this).data('id');
                $('#delete_id').val(id);
                $('#deleteModal').modal('show');
            });


            //delete
            $('#deleteForm').submit(function (e) {
                e.preventDefault();
                let id = $('#delete_id').val();

                $.ajax({
                    url: `/pengembalian/${id}`,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        $('#deleteModal').modal('hide');
                        $('#table_pengembalian').DataTable().ajax.reload();
                        alert(res.message);
                    },
                    error: function (err) {
                        alert('Terjadi kesalahan saat menghapus.');
                        console.log(err.responseText);
                    }
                });
            });
        });
    </script>
@endpush