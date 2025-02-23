@extends("layout.app")
@section("title", "Detail Peminjaman")
@section("header", "Detail Peminjaman")

{{-- Css Styling --}}
@push ("css-libs")
    <meta name="csrf_token" content="{{csrf_token()}}" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
@endpush

@section('content')
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
<div>Ini Detail Peminjaman</div>

@endsection