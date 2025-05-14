@extends("layout.app")
@section("title", "Katalog")
@section("header", "Katalog")

@push ("css-libs")
    <meta name="csrf_token" content="{{csrf_token()}}" />
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

        .add-btn {
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
                <ul class="breadcrumb">
                    <li><a href="#">Dashboard</a></li>
                    /
                </ul>
            </div>
            
            <div class="right">
                <a href="#" class="add-btn">
                    <i class="bx bx-book-add"></i>
                    <span>Tambah Buku</span>
                </a>
            </div>
        </div>
    </div>

    <div class="container">
    @if ($bukus)
        @foreach ( $bukus as $buku)
            <div class="card" class="ml-5 mt-5 ml-5 p-2" style="width:20rem;">
                <img src="/images{{$buku->foto}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$buku->title}}</h5>
                    <p class="card-text"><b>Kategori : {{$buku->kategoris->nama_kategori}}</b></p>
                    <a href="#" class="btn btn-primary">Detail</a>
                </div>
            </div>
        @endforeach
    @endif
    </div>

    <!-- <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Agama</h5>
                </div>

                <div class="d-flex card-body justify-content-center">
                    <img src="https://cdn.gramedia.com/uploads/items/Buku_Cerita_dan_Aktivitas_Anak_Muslim-2.jpeg" alt=""
                        width="270px" height="350px">
                </div>
                <div class="card-footer mb-3 text-end">
                    <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                    <button class="btn btn-success btn-sm">Details</button>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
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
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Psikologi</h5>
                </div>

                <div class="d-flex card-body justify-content-center">
                    <img src="https://cdn.gramedia.com/uploads/items/9786020639710_PSYCHOLOGY_C_1_4_R-1.jpg" alt=""
                        width="270px" height="350px">
                </div>
                <div class="card-footer mb-3 text-end">
                    <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                    <button class="btn btn-success btn-sm">Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Teknik</h5>
                </div>

                <div class="d-flex card-body justify-content-center">
                    <img src="https://dpk.kepriprov.go.id/resources/cover/2019-09-02_SATU-JAM-BELAJAR-TEKNIK-HACKING-FOR-NEWBIE-A-DIPANEGARA_022500.jpg"
                        alt="" width="270px" height="350px">
                </div>
                <div class="card-footer mb-3 text-end">
                    <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                    <button class="btn btn-success btn-sm">Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Agama</h5>
                </div>

                <div class="d-flex card-body justify-content-center">
                    <img src="https://cdn.gramedia.com/uploads/items/9786027926295_Tuhan-Maha-As.jpg" alt="" width="270px"
                        height="350px">
                </div>
                <div class="card-footer mb-3 text-end">
                    <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                    <button class="btn btn-success btn-sm">Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Agama</h5>
                </div>
                <div class="d-flex card-body justify-content-center">
                    <img src="https://henbuk.com/assets/buku/img/202708064.jpg" alt="" width="270px" height="350px">
                </div>
                <div class="card-footer mb-3 text-end">
                    <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                    <button class="btn btn-success btn-sm">Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Kepemimpinan</h5>
                </div>
                <div class="d-flex card-body justify-content-center">
                    <img src="https://www.gramedia.com/blog/content/images/2022/07/The-Book-of-Sukses-Memimpin.jpg" alt=""
                        width="270px" height="350px">
                </div>
                <div class="card-footer mb-3 text-end">
                    <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                    <button class="btn btn-success btn-sm">Details</button>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card">
                <div class="card-header">
                    <h5>Kesehatan</h5>
                </div>
                <div class="d-flex card-body justify-content-center">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRVhVdHQZ4Th-DacmexWd66RCCLMX1iI6P1zA&s"
                        alt="" width="270px" height="350px">
                </div>
                <div class="card-footer mb-3 text-end">
                    <button class="btn btn-primary btn-sm" style="margin-right: 10px">Take Now</button>
                    <button class="btn btn-success btn-sm">Details</button>
                </div>
            </div>
        </div>

    </div>  -->
@endsection 