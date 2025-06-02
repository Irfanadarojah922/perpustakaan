@extends('layout.app')
@section('title', 'Peminjaman')
@section('header', 'Peminjaman')

{{-- Css Styling --}}
@push('css-libs')
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
@endpush

@section('content')

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
          <h4 class="card-title  mb-0 flex-grow-1">Tabel Peminjaman</h4>
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
            <table id="table_peminjaman" class="table table-bordered table-striped" style="width:100%">
              <thead>
                <tr class="text-right">
                  <th scope="col">No</th>
                  <th scope="col">No NIK</th>
                  <th scope="col">Nama Anggota</th>
                  <th scope="col">Kode Buku</th>
                  <th scope="col">Judul Buku</th>
                  <th scope="col">Tanggal Pinjam</th>
                  {{-- <th scope="col">Tanggal Harus Kembali</th> --}}
                  {{-- <th scope="col">Status Pengembalian</th> --}}

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

    @include('sirkulasi.peminjaman.create')
    @include('sirkulasi.peminjaman.edit')
    @include('sirkulasi.peminjaman.delete')


    @if ($errors->any())
      <script>
        document.addEventListener('DOMContentLoaded', function() {
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

@endpush

@push('scripts')
  <script>
    $(document).ready(function() {
      $('#table_peminjaman').DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: '{{ url()->current() }}',
        columns: [
          // {data: 'id', name: 'id'},
          {
              data: null,       //untuk menghitung jumlah baris mulai dari 1
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },

          {data: 'anggotas.nik', name: 'anggota_id'},
          {data: 'anggotas.nama', name: 'anggota_id'},
          {data: 'bukus.kode_buku', name: 'buku_id'},
          {data: 'bukus.judul', name: 'buku_id'},
          {data: 'tanggal_pinjam', name: 'tanggal_pinjam'},
          {data: 'action', name: 'action'}
        ],

        columnDefs: [
          { targets: [0, 5], className: 'dt-left'}
        ] 
      });

      // utk input pengembalian
      $.get(`/peminjaman/add`, function(res) {
        let data = res.data;

        // console.log(anggota.id);
        let anggotaOptions = ``;
        res.anggotas.forEach(function(anggota) {
            anggotaOptions += `<option value="${anggota.id}">${anggota.nik}</option>`;
          });
        $('#add_anggota_nik').html(anggotaOptions);


        // console.log(judul buku);
        let bukuOptions = ``;
        res.bukus.forEach(function(buku) {

            bukuOptions += `<option value="${buku.id}">${buku.kode_buku}</option>`;
          });
        $('#add_kode_buku').html(bukuOptions);        
      });



      //edit
      $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');

        $.get(`/peminjaman/${id}/edit`, function(res) {
          let data = res.data;

          $('#edit_id').val(data.id);
          $('#edit_tanggal_pinjam').val(data.tanggal_pinjam);
          $('#edit_tanggal_harus_kembali').val(data.tanggal_kembali);

          
          // Populate select buku
          let bukuOptions = '';
          res.bukus.forEach(function(buku) {
            bukuOptions += `<option value="${buku.id}" ${buku.id == data.buku_id ? 'selected' : ''}>${buku.kode_buku}</option>`;          
          });
          $('#edit_kode_buku').html(bukuOptions); 

          let judulOptions = '';
          res.bukus.forEach(function(buku) {
            judulOptions += `<option value="${buku.id}" ${buku.id == data.buku_id ? 'selected' : ''}> ${buku.judul}</option>`;          
          });
          $('#edit_judul').html(judulOptions); 


          // Populate select anggota
          let anggotaOptions = ``;
          res.anggotas.forEach(function(anggota) {
            // console.log(anggota.id);
            anggotaOptions += `<option value="${anggota.id}" ${anggota.id == data.anggota_id ? 'selected' : ''}>${anggota.nik}</option>`;
          });
          $('#edit_anggota_nik').html(anggotaOptions);

          let namaOptions = ``;
          res.anggotas.forEach(function(anggota) {
            // console.log(anggota.id);
            namaOptions += `<option value="${anggota.id}" ${anggota.id == data.anggota_id ? 'selected' : ''}> ${anggota.nama}</option>`;
          });
          $('#edit_nama').html(namaOptions);          


          $('#editModal').modal('show');
        });
      });

      $('#editForm').submit(function(e) {
        e.preventDefault();
        let id = $('#edit_id').val();
        $.ajax({

          url: `/peminjaman/${id}`,
          method: 'PUT',
          data: $(this).serialize(),
          success: function(res) {
            $('#editModal').modal('hide');
            $('#table_peminjaman').DataTable().ajax.reload();
            alert('Data berhasil diupdate!');
          },
          error: function(err) {
            alert('Terjadi kesalahan saat mengupdate.');
            console.log(err.responseJSON);
          }
        });
      });


      //delete data
      $(document).on('click', '.deleteBtn', function () {
        let id = $(this).data('id');
        $('#delete_id').val(id);
        $('#deleteModal').modal('show');
      });

      $('#deleteForm').submit(function (e) {
        e.preventDefault();
          let id = $('#delete_id').val();

        $.ajax({
          url: `/peminjaman/${id}`,
          type: 'POST',
          data: {
           _method: 'DELETE',
           _token: '{{ csrf_token() }}'
          },
          success: function (res) {
              $('#deleteModal').modal('hide');
              $('#table_peminjaman').DataTable().ajax.reload();
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