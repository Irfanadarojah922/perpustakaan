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
            flex-wrap: wrap; /* Allow wrapping for responsiveness */
            gap: 15px; /* Spacing between columns */
        }

        .left h1 {
            margin: 0;
        }

        .right {
            display: flex;
            gap: 10px;
            flex-wrap: wrap; /* Allow wrapping for buttons/search */
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

        .search-container {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            border-radius: 20px; /* Rounded corners for the search bar */
            overflow: hidden;
            background-color: #fff;
            padding: 0 5px;
            height: 38px; /* Match button height */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow */
        }

        .search-input {
            border: none;
            outline: none;
            padding: 0 10px;
            flex-grow: 1;
            font-size: 1rem;
            color: #333;
        }

        .search-button {
            background: none;
            border: none;
            padding: 0 10px;
            cursor: pointer;
            color: var(--primary); /* Use primary color for icon/text */
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-button:hover {
            opacity: 0.8;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .col {
                flex-direction: column;
                align-items: flex-start;
            }
            .right {
                width: 100%;
                justify-content: flex-start;
            }
            .search-container {
                width: 100%; /* Full width on smaller screens */
            }
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
                <!-- Search Box -->
                <form action="{{ route('katalog.index') }}" method="GET" class="search-container">
                    <input type="search" name="search" class="search-input" placeholder="Cari buku..." value="{{ request('search') }}">
                    <button type="submit" class="search-button">
                        <i class='bx bx-search'></i> 
                    </button>
                </form>

              <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                Tambah buku
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
                            <img src="{{ $buku->foto_url }}" class="card-img-top" alt="gambar">
                            <div class="card-body">
                                <h6 class="card-title">{{ $buku->judul }}</h6>
                                <p class="card-text"><b>Kategori : {{ $buku->kategori?->nama_kategori }}</b></p>
                                <!-- <p class="card-text"><b>Deskripsi :</b> {{ $buku->deskripsi ?? '-' }}</p> -->
                                <a href="{{ route('katalog.show', $buku->id) }}" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @include('katalog.create')

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                  var myModal = new bootstrap.Modal(document.getElementById('createModal'));
            myModal.show();
            })
        </script>
    @endif
    
@endsection 