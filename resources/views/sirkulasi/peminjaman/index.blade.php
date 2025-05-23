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
                  <th scope="col">Nama Anggota</th>
                  <th scope="col">Judul Buku</th>
                  <th scope="col">Kategori Buku</th>
                  <th scope="col">Tanggal Pinjam</th>
                  <th scope="col">Tanggal Harus Kembali</th>
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
              data: null,
              render: function (data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          {data: 'anggotas.nama', name: 'anggota_id'},
          {data: 'bukus.judul', name: 'buku_id'},
          {data: 'kategoris.nama_kategori', name: 'kategori_id'},
          {data: 'tanggal_pinjam', name: 'tanggal_pinjam'},
          {data: 'tanggal_kembali', name: 'tanggal_kembali'},
          // {data: 'status_pengembalian', name: 'status_pengembalian'},
          {data: 'action', name: 'action'}
        ],

        columnDefs: [
          { targets: [0, 5], className: 'dt-left'}
        ]
       
      });

      // utk form input
      $.get(`/peminjaman/add`, function(res) {
        let data = res.data;

        // console.log(anggota.id);
        let anggotaOptions = ``;
        res.anggotas.forEach(function(anggota) {
            anggotaOptions += `<option value="${anggota.id}">${anggota.nama}</option>`;
          });
        $('#add_anggota_id').html(anggotaOptions);

        // console.log(judul buku);
        let bukuOptions = ``;
        res.bukus.forEach(function(buku) {

            bukuOptions += `<option value="${buku.id}">${buku.judul}</option>`;
          });
        $('#add_buku_id').html(bukuOptions);
          
        // console.log(kategori);
        let kategoriOptions = ``;
        res.kategoris.forEach(function(kategori) {

            kategoriOptions += `<option value="${kategori.id}">${kategori.nama_kategori}</option>`;
          });
        $('#add_kategori_id').html(kategoriOptions);

        // console.log(status);
        // let pinjamOptions = ``;
        // res.pinjams.forEach(function(pinjam) {

        //     pinjamOptions += `<option value="${pinjam.id}">${pinjam.status_pengembalian}</option>`;
        //   });
        // $('#add_pinjam_id').html(pinjamOptions);
      });

      $(document).on('click', '.editBtn', function() {
        let id = $(this).data('id');

        $.get(`/peminjaman/${id}/edit`, function(res) {
          let data = res.data;

          $('#edit_id').val(data.id);
          $('#edit_tanggal_pinjam').val(data.tanggal_pinjam);
          $('#edit_tanggal_kembali').val(data.tanggal_kembali);
          // $('#edit_status_pengembalian').val(data.status_pengembalian);

          // Populate select status_pengembalian
          // let statusOptions = ['Dipinjam', 'Dikembalikan'];
          // let statusSelect = $('#edit_status_pengembalian');
          // statusSelect.empty();
          // statusOptions.forEach(function(status) {
          //   statusSelect.append(`<option value="${status}" ${status == data.status_pengembalian ? 'selected' : ''}>${status}</option>`);
        
          
          // Populate select buku
          let bukuOptions = '';
          res.bukus.forEach(function(buku) {
            bukuOptions +=
              `<option value="${buku.id}" ${buku.id == data.buku_id ? 'selected' : ''}>${buku.judul}</option>`;
          });
          $('#edit_buku_id').html(bukuOptions);

          // Populate select anggota
          let anggotaOptions = ``;
          res.anggotas.forEach(function(anggota) {
            // console.log(anggota.id);
            anggotaOptions += `<option value="${anggota.id}" ${anggota.id == data.anggota_id ? 'selected' : ''}>${anggota.nama}</option>`;
          });
          $('#edit_anggota_id').html(anggotaOptions);

          // Populate select kategori
          let kategoriOptions = '';
          res.kategoris.forEach(function(kategori) {
            kategoriOptions +=
              `<option value="${kategori.id}" ${kategori.id == data.kategori_id ? 'selected' : ''}>${kategori.nama_kategori}</option>`;
          });
          $('#edit_kategori_id').html(kategoriOptions);

          $('#editModal').modal('show');
        });
      });

      //   $(document).on('click', '.editBtn', function() {
      //     let id = $(this).data('id');
      //     $.get(`/peminjaman/${id}/edit`, function(res) {
      //       $('#edit_id').val(res.id);
      //       $('#edit_tanggal_pinjam').val(res.tanggal_pinjam);
      //       $('#edit_tanggal_kembali').val(res.tanggal_kembali);
      //       $('#edit_status_pengembalian').val(res.status_pengembalian);
      //       $('#edit_anggota_id').val(res.anggota_id);
      //       $('#edit_buku_id').val(res.buku_id);
      //       $('#edit_kategori_id').val(res.kategori_id);
      //       $('#editModal').modal('show');
      //     });
      //   });

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