@extends('layout.app')
@section('title', 'Peminjaman')
@section('header', 'Peminjaman')

{{-- Css Styling --}}
@push('css-libs')
  <meta name="csrf_token" content="{{ csrf_token() }}" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
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
      <a href="" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
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
    document.addEventListener('DOMContentLoaded', function () {
    var myModal = new bootstrap.Modal(document.getElementById('addModal'));
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

@push('scripts')
  <script>
    $(document).ready(function () {


    //Select2 initialize

    function initSelect2AddModal(select, url, callback) {
      $(select).select2({
      theme: 'bootstrap-5',
      dropdownParent: $('#addModal'),
      ajax: {
        url: url,
        dataType: 'json',
        delay: 250,
        method: 'GET',
        data: function (params) {
        var query = {
          q: params.term
        };
        return query;
        },
        processResults: callback
      },
      caches: true
      });
    }


    //add
    initSelect2AddModal('#add_anggota_nik', '{{ route('search.peminjaman.anggota') }}', function (data) {
      result = $.map(data.anggota, function (item) {
      return {
        id: item.id,
        text: item.nik
      }
      })

      return {
      results: result
      };
    });

    initSelect2AddModal('#add_kode_buku', '{{ route('search.peminjaman.buku') }}', function (data) {
      result = $.map(data.buku, (item) => {
      return {
        id: item.id,
        text: item.kode_buku
      }
      })
      return {
      results: result
      };
    })



    //yang ditampilkan di list tabel
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

      { data: 'anggotas.nik', name: 'anggota_id' },
      { data: 'anggotas.nama', name: 'anggota_id' },
      { data: 'bukus.kode_buku', name: 'buku_id' },
      { data: 'bukus.judul', name: 'buku_id' },
      { data: 'tanggal_pinjam', name: 'tanggal_pinjam' },
      { data: 'action', name: 'action' }
      ],

      columnDefs: [
      { targets: [0, 5], className: 'dt-left' }
      ]
    });


      // select2 edit
      $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');

        $.get(`/peminjaman/${id}/edit`, function (res) {
        let data = res.data;

        // Isi field input biasa
        $('#edit_id').val(data.id);
        $('#edit_tanggal_pinjam').val(data.tanggal_pinjam);
        $('#edit_tanggal_harus_kembali').val(data.tanggal_pengembalian);

        // Select2 Anggota (#edit_anggota)
        $('#edit_anggota').empty();

        $('#edit_anggota').select2({
          theme: 'bootstrap-5',
          dropdownParent: $('#editModal'), // Ini mengarahkan Select2 ke modal edit
          placeholder: 'Cari NIK atau Nama Anggota...',
          ajax: {
          url: '{{ route('search.peminjaman.anggota') }}', // Route untuk mencari anggota
          dataType: 'json',
          delay: 250,
          method: 'GET',
          data: function (params) {
            return { q: params.term };
          },

          processResults: function (data) {
            return {
            results: $.map(data.anggota, function (item) {
              console.log(item);
              
              return {
              id: item.id,
              // Gabungkan NIK dan Nama di tampilan Select2
              text: item.nik + ' - ' + item.nama
              }
            })
            };
          }
          }
        });

      //  data 'id' dan 'text' (NIK - Nama) dari anggota yang sudah dipilih
      if (data.anggota_id && data.anggotas) {
        // Buat opsi baru untuk Select2 dengan NIK dan Nama gabungan
        var option = new Option(data.anggotas.nik + ' - ' + data.anggotas.nama, data.anggota_id, true, true);

        $('#edit_anggota').append(option).trigger('change');
      } else {
        $('#edit_anggota').val(null).trigger('change');
      }


      // Nilai Select2 Buku (#edit_buku)
      $('#edit_buku').empty();

      $('#edit_buku').select2({
        theme: 'bootstrap-5',
        dropdownParent: $('#editModal'),
        placeholder: 'Cari Kode atau Judul Buku...',
        ajax: {
        url: '{{ route('search.peminjaman.buku') }}', // Route untuk mencari buku
        dataType: 'json',
        delay: 250,
        method: 'GET',
        data: function (params) {
          return { q: params.term };
        },
        processResults: function (data) {
          return {
          results: $.map(data.buku, function (item) {
            return {
            id: item.id,
            text: item.kode_buku + ' - ' + item.judul
            }
          })
          };
        }
        }
      });

      if (data.buku_id && data.bukus) { // Pastikan ada buku_id dan objek buku yang terpilih
        var option = new Option(data.bukus.kode_buku + ' - ' + data.bukus.judul, data.buku_id, true, true);
        $('#edit_buku').append(option).trigger('change');
      } else {
        $('#edit_buku').val(null).trigger('change');
      }

      // Tampilkan Modal Edit
      $('#editModal').modal('show');
      });
    });

    $('#editForm').submit(function (e) {
      e.preventDefault();
      let id = $('#edit_id').val();

      $.ajax({
      url: `/peminjaman/${id}`,
      type: 'PUT',
      data: $(this).serialize(),
      success: function (res) {
        $('#editModal').modal('hide');
        $('#table_peminjaman').DataTable().ajax.reload();
      },
      error: function (err) {
        alert('Terjadi kesalahan saat memperbarui data.');
        console.log(err.responseText);
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