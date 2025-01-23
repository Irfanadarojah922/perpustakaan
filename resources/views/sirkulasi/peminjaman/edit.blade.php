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

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Peminjaman</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('peminjaman.index' }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('peminjaman.update',$pinjam->id) }}" method="POST">
        @csrf
       
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Anggota ID </strong>
                    <input type="text" name="anggota_id" value="{{ $pinjam->anggota_id }}" class="form-control" placeholder="anggota_id">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Buku ID </strong>
                    <input type="text" name="buku_id" value="{{ $pinjam->buku_id }}" class="form-control" placeholder="buku_id">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Kategori ID </strong>
                    <input type="text" name="kategori_id" value="{{ $pinjam->kategori_id }}" class="form-control" placeholder="kategori_id">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Tanggal Pinjam </strong>
                    <input type="date" name="tanggal_pinjam" value="{{ $pinjam->tanggal_pinjam }}" class="form-control" placeholder="tanggal_pinjam">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Tanggl Kembali </strong>
                    <input type="date" name="tanggal_kembali" value="{{ $pinjam->tanggal_kembali }}" class="form-control" placeholder="tanggal_kembali">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong> Tanggal Kembali </strong>
                    <input type="date" name="tanggal_kembali" value="{{ $pinjam->tanggal_kembali }}" class="form-control" placeholder="tanggal_kembali">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

@endsection