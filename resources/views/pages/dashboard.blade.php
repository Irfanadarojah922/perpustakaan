@extends("layout.app")
@section("title", "Dashboard")
@section("header", "Dashboard")

{{-- Css Styling --}}
@push ("css-libs")
    <style>
    </style>
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
</div>  

{{-- <div class="flex">
    <div class="card">
        <div class="card-header">
            <h5>Judul Buku</h5>
        </div>
        <div class="card-body">
            <div class="card-body">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt=""
                width="270px" height="350px">
            </div> 
        </div> 
        
        <div class="card-footer text-end">
            <button class="btn-primary" style="margin-right: 10px">Take Now</button>
            <button class="btn-success">Details</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Judul Buku</h5>
        </div>
        <div class="card-body">
            <div class="card-body">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt=""
                width="270px" height="350px">
            </div> 
        </div> 
        
        <div class="card-footer text-end">
            <button class="btn-primary" style="margin-right: 10px">Take Now</button>
            <button class="btn-success">Details</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Judul Buku</h5>
        </div>
        <div class="card-body">
            <div class="card-body">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt=""
                width="270px" height="350px">
            </div> 
        </div> 
        
        <div class="card-footer text-end">
            <button class="btn-primary" style="margin-right: 10px">Take Now</button>
            <button class="btn-success">Details</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5>Judul Buku</h5>
        </div>
        <div class="card-body">
            <div class="card-body">
                <img src="https://bukukita.com/babacms/displaybuku/117226_f.jpg" alt=""
                width="270px" height="350px">
            </div> 
        </div> 
        
        <div class="card-footer text-end">
            <button class="btn-primary" style="margin-right: 10px">Take Now</button>
            <button class="btn-success">Details</button>
        </div>
    </div>
</div> --}}

 
<!-- Insights -->
    <ul class="insights">
        <li>
            <i class='bx bx-book'></i>
            <span class="info">
                <h3>
                    {{ $kategoris }}
                </h3>
                <p>Total Katalog</p>
            </span>
        </li>

        <li>
            <i class='bx bx-group'></i>
            <span class="info">
                <h3>
                    {{ $anggotas }}
                </h3>
                <p>Total Anggota</p>
            </span>
        </li>

        <li>
            <i class='bx bx-book-bookmark'></i>
            <span class="info">
                <h3>
                    {{ $pinjams }}
                </h3>
                <p>Total Peminjaman</p>
            </span>
        </li>

        <li>
            <i class='bx bx-book-reader'></i>
            <span class="info">
                <h3>
                    {{ $kembalis }}
                </h3>
                <p>Total Pengembalian</p>
            </span>
        </li>
    </ul>
    <!-- End of Insights -->

    <div class="bottom-data">

        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>Transaksi Terakhir </h3>
                <i class='bx bx-filter'></i>
                <i class='bx bx-search'></i>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama Anggota</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/images.jpeg') }}" alt="Gambar" width="200">
                            <p>John Doe</p>
                        </td>
                        <td>24-01-2025</td>
                        <td>
                            <span class="status pending">Pengembalian</span></td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/images.jpeg') }}" alt="Gambar" width="200">
                            <p>John Doe</p>
                        </td>
                        <td>24-01-2025</td>
                        <td>
                            <span class="status pending">Pengembalian</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Reminders -->
        <div class="reminders">
            <div class="header">
                <i class='bx bx-note'></i>
                <h3>Pengingat</h3>
                <i class='bx bx-filter'></i>
                <i class='bx bx-search'></i>            
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tgl Pinjam</th>
                        <th>Jatuh Tempo</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/images.jpeg') }}" alt="Gambar" width="200">
                            <p>John Doe</p>
                        </td>
                        <td>24-01-2025</td>
                        <td>04-02-2025</td>

                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/images.jpeg') }}" alt="Gambar" width="200">
                            <p>John Doe</p>
                        </td>
                        <td>24-01-2025</td>
                        <td>04-02-2025</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="{{ asset('assets/images/images.jpeg') }}" alt="Gambar" width="200">
                            <p>John Doe</p>
                        </td>
                        <td>24-01-2025</td>
                        <td>04-02-2025</td>
                    </tr>
                    <tr>
                    </tbody>
            </table>
        
        </div>
        <!-- End of Reminders-->

    </div> 
@endsection