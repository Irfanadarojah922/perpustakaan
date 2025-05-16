@extends("layout.appShow")

@section('content')
{{-- Banner --}}
<div class="banner mb-5">
    <div>
        <h2 class="fw-bold">Detail  |  Pustaka Pintar</h2>
        <p class="text-light">Selamat Datang di Halaman Katalog Aplikasi Pustaka Pintar</p>
    </div>
</div>

{{-- Konten Detail Buku --}}
<div class="container">
    <div class="row">
        {{-- Gambar Buku --}}

        <div class="col-md-4 mb-4">
            <img src="{{ asset($bukus->foto) }}" class="cover-buku img-fluid" alt="cover buku">
        </div>

        {{-- Detail Buku --}}
        <div class="col-md-8">
            <h3 class="fw-bold">{{ $bukus->judul }}</h3>
            <p class="mt-3">{{ $bukus->deskripsi }}</p>

            <div class="row mt-4">
                <div class="col-sm-6">
                    <h6 class="fw-semibold">Penerbit</h6>
                    <p>{{ $bukus->penerbit }}</p>

                    <h6 class="fw-semibold">Penulis</h6>
                    <p>{{ $bukus->penulis }}</p>

                    <h6 class="fw-semibold">ISBN</h6>
                    <p>{{ $bukus->isbn }}</p>
                </div>

                <div class="col-sm-6">
                    <h6 class="fw-semibold">Tahun Penerbit</h6>
                    <p>{{ $bukus->tahun_terbit }}</p>

                    <h6 class="fw-semibold">Jumlah Eksemplar</h6>
                    <p>{{ $bukus->jumlah_eksemplar }}</p>

                    <h6 class="fw-semibold">Jumlah Tersedia</h6>
                    <p>{{ $bukus->jumlah_tersedia }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
