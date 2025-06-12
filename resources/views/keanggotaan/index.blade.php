@extends("layout.app")
@section("title", "Keanggotaan")
@section("header", "Keanggotaan")

{{-- Css Styling --}}
@push ("css-libs")
    <meta name="csrf_token" content="{{ csrf_token() }}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
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
                        data-bs-target="#addModal">
                        <i class="bx bx-plus" style="font-size:1rem;"></i>
                        Add
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_anggota" class="table table-sm table-bordered table-striped"
                        style="width:100%; white-space: nowrap;">
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
   

@endsection

@push('script-libs')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
@endpush

@push("scripts")
    <script>
        let anggotaDataTable; 
        $(document).ready(function () {

            //yang ditampilkan di list tabel
            anggotaDataTable = $('#table_anggota').DataTable({
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



            // mengosongkan semua input di dalam form modal 'addModal'
            function resetAddAnggotaForm() {
                $('#formAddAnggota')[0].reset();

                $('#formAddAnggota .is-invalid').removeClass('is-invalid');
                $('#formAddAnggota .invalid-feedback').remove();

                $('#add_jenis_kelamin').val('');
                $('#add_pendidikan').val('');
                $('#add_status').val('');
                $('#no_telp_error').val(); 
            }

            $('#addModal').on('show.bs.modal', function() {
                resetAddAnggotaForm(); // reset setiap kali modal dibuka
            });

            // Validasi nomor telepon harus diawali +62
            $(document).on('input', '#add_no_telepon', function () {
                let value = $(this).val();
                let errorElement = $('#no_telp_error'); 

                if (!value.startsWith('+62')) {
                    errorElement.text('Nomor telepon harus diawali dengan +62').show();
                    $(this).addClass('is-invalid'); 
                } else {
                    errorElement.hide();
                    $(this).removeClass('is-invalid'); 
                }
            });


            // --- Add ---
            $('#formAddAnggota').on('submit', function(e) {
                e.preventDefault();

                let token = $('meta[name="csrf-token"]').attr('content');
                let formData = new FormData(this); //

                let storeUrl = '{{ route('keanggotaan.store') }}';

                $.ajax({
                    url: storeUrl,
                    type: 'POST',
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    headers: {
                        'X-CSRF-TOKEN': token 
                    },
                    success: function(response) {
                        alert(response.message);
                        $('#addModal').modal('hide');
                        anggotaDataTable.ajax.reload();
                        console.log('Anggota berhasil ditambahkan:', response.anggota);
                    },
                    error: function(xhr) {
                        $('#formAddAnggota .is-invalid').removeClass('is-invalid');
                        $('#formAddAnggota .invalid-feedback').remove();
                        $('#no_telp_error').remove(); 

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            for (let field in errors) {
                                let inputElement = $('#add_' + field); 
                                if (inputElement.length === 0) {
                                    inputElement = $('#' + field); 
                                }

                                if (inputElement.length > 0) {
                                    inputElement.addClass('is-invalid'); 
                                    let errorDiv = `<div class="invalid-feedback">${errors[field][0]}</div>`;
                                    if (inputElement.attr('type') === 'file') {
                                        inputElement.closest('.mb-3').append(errorDiv);
                                    } else if (inputElement.is('select') || inputElement.is('textarea')) {
                                        inputElement.after(errorDiv);
                                    } else {
                                        inputElement.after(errorDiv); 
                                    }
                                }
                                errorMessages += errors[field][0] + '\n';
                            }
                                alert('Terjadi kesalahan validasi:\n' + errorMessages);
                        } else {
                            alert('Terjadi kesalahan server: ' + (xhr.responseJSON.message || 'Unknown error'));
                             console.error('Server Error:', xhr.responseText);
                        }
                    }
                });
            });


            //edit

            $(document).on('click', '.editBtn', function () {
                let id = $(this).data('id');
                let showUrl = '{{ route("keanggotaan.edit", ":id") }}';
                showUrl = showUrl.replace(':id', id);

                // Bersihkan feedback validasi sebelumnya
                $('#formEditAnggota .is-invalid').removeClass('is-invalid');
                $('#formEditAnggota .invalid-feedback').remove();
                $('#edit_no_telp_error').hide(); // Sembunyikan error no telepon

                $.ajax({
                    url: showUrl,
                    type: 'GET',
                    success: function (response) {
                        
                        // Isi data ke form edit
                        $('#edit_id').val(response.data.id);
                        $('#edit_nik').val(response.data.nik);
                        $('#edit_nama').val(response.data.nama);
                        $('#edit_tempat_lahir').val(response.data.tempat_lahir);
                        $('#edit_tanggal_lahir').val(response.data.tanggal_lahir);
                        $('#edit_jenis_kelamin').val(response.data.jenis_kelamin);
                        $('#edit_pendidikan').val(response.data.pendidikan);
                        $('#edit_alamat').val(response.data.alamat);
                        $('#edit_no_telepon').val(response.data.no_telepon);
                        $('#edit_status').val(response.data.status);
                        $('#edit_tanggal_daftar').val(response.data.tanggal_daftar);

                        $('#edit_modal').modal('show');
                    },
                    error: function (xhr) {
                        alert('Gagal mengambil data anggota: ' + (xhr.responseJSON.message || 'Unknown error'));
                        console.error('Error fetching data:', xhr.responseText);
                    }
                });
            });

            $('#formEditAnggota').on('submit', function(e) {
                e.preventDefault();

                let id = $('#edit_id').val();
                let token = $('meta[name="csrf-token"]').attr('content');
                let formData = new FormData(this);
                formData.append('_method', 'PUT'); 

                let updateUrl = '{{ route('keanggotaan.update', ':id') }}';
                updateUrl = updateUrl.replace(':id', id);

                $.ajax({
                    url: updateUrl,
                    type: 'POST',
                    data: formData,
                    processData: false, 
                    contentType: false, 
                    headers: {
                        'X-CSRF-TOKEN': token 
                    },

                    success: function(response) {
                        alert(response.message);
                        $('#edit_modal').modal('hide');
                        anggotaDataTable.ajax.reload(); 
                        $('#formEditAnggota .is-invalid').removeClass('is-invalid');
                        $('#formEditAnggota .invalid-feedback').remove();
                        $('#edit_no_telp_error').hide(); // Sembunyikan error no telepon
                    },
                    
                    error: function(xhr) {
                        $('#formEditAnggota .is-invalid').removeClass('is-invalid');
                        $('#formEditAnggota .invalid-feedback').remove();
                        $('#edit_no_telp_error').hide(); // Sembunyikan error no telepon

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessages = '';
                            for (let field in errors) {
                                let inputElement = $('#edit_' + field); 
                                if (inputElement.length === 0) {
                                    inputElement = $('#' + field); 
                                }

                                if (inputElement.length > 0) {
                                    inputElement.addClass('is-invalid'); 
                                    let errorDiv = `<div class="invalid-feedback">${errors[field][0]}</div>`;
                                    if (inputElement.attr('type') === 'file') {
                                        inputElement.closest('.mb-3').append(errorDiv);
                                    } else if (inputElement.is('select') || inputElement.is('textarea')) {
                                        inputElement.after(errorDiv);
                                    } else {
                                        inputElement.after(errorDiv); 
                                    }
                                }
                                errorMessages += errors[field][0] + '\n';
                            }
                                alert('Terjadi kesalahan validasi:\n' + errorMessages);
                        } else {
                            alert('Terjadi kesalahan server: ' + (xhr.responseJSON.message || 'Unknown error'));
                            console.error('Server Error:', xhr.responseText);
                        }
                    }
                });
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