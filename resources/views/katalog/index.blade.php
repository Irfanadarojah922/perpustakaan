@extends("layout.app")
@section("title", "Katalog")
@section("header", "Katalog")

@push ("css-libs")
    <meta name="csrf_token" content="{{csrf_token()}}" />
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
            {{-- <li><a href="/katalog" class="active">Katalog</a></li> --}}
        </ul>
    </div>
    <a href="#" class="report">
        <i class='bx bx-cloud-download'></i>
        <span>Download CSV</span>
    </a>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h5>Agama</h5>
            </div>

            <div class="d-flex card-body justify-content-center">
                <img src="https://cdn.gramedia.com/uploads/items/Buku_Cerita_dan_Aktivitas_Anak_Muslim-2.jpeg" alt="" width="270px" height="350px">
            </div>
            <div class="card-footer mb-3 text-end">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                <button class="btn btn-success btn-sm">Details</button>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h5>Fiksi</h5>
            </div>

            <div class="d-flex card-body justify-content-center">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt="" width="270px" height="350px">
            </div>
            <div class="card-footer mb-3 text-end">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                <button class="btn btn-success btn-sm">Details</button>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h5>Psikologi</h5>
            </div>

            <div class="d-flex card-body justify-content-center">
                <img src="https://cdn.gramedia.com/uploads/items/9786020639710_PSYCHOLOGY_C_1_4_R-1.jpg" alt="" width="270px" height="350px">
            </div>
            <div class="card-footer mb-3 text-end">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                <button class="btn btn-success btn-sm">Details</button>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card">
            <div class="card-header">
                <h5>Teknik</h5>
            </div>

            <div class="d-flex card-body justify-content-center">
                <img src="https://dpk.kepriprov.go.id/resources/cover/2019-09-02_SATU-JAM-BELAJAR-TEKNIK-HACKING-FOR-NEWBIE-A-DIPANEGARA_022500.jpg" alt="" width="270px" height="350px">
            </div>
            <div class="card-footer mb-3 text-end">
                <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                <button class="btn btn-success btn-sm">Details</button>
            </div>
        </div>
    </div>
</div>
@endsection


