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
                    data-bs-target="#exampleModal">
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
                            <th scope="col">NIK</th>
                            <th scope="col">Nama Anggota</th>
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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script> -->
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
@endpush

@push("scripts")
    <script>
        $(document).ready(function () {             //yang ditampilkan di list tabel
            $('#table_pengembalian').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: '{{url()->current()}}',
                columns: [
                    // { data: 'id', name: 'id' },
                    { data: 'anggota.anggota_nik', name: 'nik' }, 
                    { data: 'anggota.nama', name: 'nama' },        
                    { data: 'bukus.judul', name: 'buku_id' },
                    { data: 'tanggal_kembali', name: 'tanggal_kembali' },
                    { data: 'denda', name: 'denda' },
                    { data: 'keterangan', name: 'keterangan' },
                    { data: 'action', name: 'action' }
                ],
                columnDefs: [
                    { targets: [0, 3], className: 'dt-left'}
                ]
            });

            // utk form input
            $.get(`/pengembalian/add`, function(res) {
                let data = res.data;

                // console.log(kode buku);
                let bukuOptions = ``;
                res.bukus.forEach(function(buku) {

                    bukuOptions += `<option value="${buku.id}">${buku.kode_buku}</option>`;
                });
                $('#add_kode_buku').html(bukuOptions);
                            
            });
            
            $(document).on('click', '.editBtn', function() {
            let id = $(this).data('id');

            $.get(`/pengembalian/${id}/edit`, function(res) {
                let data = res.data;

                $('#edit_nik').val(data.nik);
                $('#edit_nama_anggota').val(data.nama_anggota);
                $('#edit_judul_buku').val(data.judul_buku);
                $('#edit_tanggal_kembali').val(data.tanggal_kembali);
                $('#edit_denda').val(data.denda);
                $('#edit_keterangan').val(data.keterangan);
              

                // Populate NIK
                let nikOptions = '';
                res.anggotas.forEach(function(anggota) {
                    nikOptions += `<option value="${anggota.id}" ${anggota.id == data.anggota_nik ? 'selected' : ''}>${anggota.anggota_nik}</option>`;
                });
                $('#edit_nik').html(nikOptions);

                // Populate anggota
                let anggotaOptions = ``;
                res.anggotas.forEach(function(anggota) {
                    // console.log(anggota.id);
                    anggotaOptions += `<option value="${anggota.id}" ${anggota.id == data.nama_anggota ? 'selected' : ''}>${anggota.nama}</option>`;
                });
                $('#edit_nama_anggota').html(anggotaOptions);

                // Populate buku
                let bukuOptions = '';
                res.bukus.forEach(function(buku) {
                    bukuOptions += `<option value="${buku.id}" ${buku.id == data.buku_id ? 'selected' : ''}>${buku.judul}</option>`;
                });
                $('#edit_buku_id').html(bukuOptions);
                    
                $('#editModal').modal('show');
            });

            //   $(document).on('click', '.editBtn', function() {
            //     let id = $(this).data('id');
            //     $.get(`/peminjaman/${id}/edit`, function(res) {
            //       $('#edit_id').val(res.id);
            //       $('#edit_pinjam_id').val(res.pinjam_id);
            //       $('#edit_buku_id').val(res.buku_id);
            //       $('#edit_tanggal_kembali').val(res.tanggal_kembali);
            //       $('#edit_denda').val(res.denda);
            //       $('#edit_keterangan').val(res.keterangan);
            //     });
            //   });

            $('#editForm').submit(function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();
                $.ajax({

                url: `/pengembalian/${id}`,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(res) {
                    $('#editModal').modal('hide');
                    $('#table_pengembalian').DataTable().ajax.reload();
                    alert('Data berhasil diupdate!');
                },
                error: function(err) {
                    alert('Terjadi kesalahan saat mengupdate.');
                    console.log(err.responseJSON);
                }
                });
            });
            });

            $('#editForm').submit(function(e) {
                e.preventDefault();
                let id = $('#edit_id').val();
                $.ajax({

                url: `/pengembalian/${id}`,
                method: 'PUT',
                data: $(this).serialize(),
                success: function(res) {
                    $('#editModal').modal('hide');
                    $('#table_pengembalian').DataTable().ajax.reload();
                    alert('Data berhasil diupdate!');
                },
                error: function(err) {
                    alert('Terjadi kesalahan saat mengupdate.');
                    console.log(err.responseJSON);
                }
                });
            });

            $(document).on('click', '.deleteBtn', function () {
                let id = $(this).data('id');
                $('#delete_id').val(id);
                $('#deleteModal').modal('show');
            });

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