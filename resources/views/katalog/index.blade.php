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
                <!-- <a href="#" class="add-btn" >
                    <i class="bx bx-book-add"></i>
                    <span>Tambah Buku</span>
                </a> -->
              <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Add buku
                </button>
            </div>

        </div>
    </div>

    <div class="container">
        @if ($bukus)
        <div class="row">
            @foreach ( $bukus as $buku)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card ml-5 mt-5 ml-5 p-2">
                        <img src="{{$buku->foto }}" class="card-img-top" alt="gambar">
                        <div class="card-body">
                            <h5 class="card-title">{{$buku->title}}</h5>
                            <p class="card-text"><b>Kategori : {{$buku->kategori?->nama_kategori}}</b></p>
                            <!-- <p class="card-text"><b>Deskripsi :</b> {{ $buku->deskripsi ?? '-' }}</p> -->
                            <a href="{{ route('katalog.show', $buku->id) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @endif
    </div>

    @include('katalog.create');

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                  var myModal = new bootstrap.Modal(document.getElementById('createModal'));
            myModal.show();
            })
          
        </script>
    @endif
    
@endsection 