@extends("layout.app")
@section("title", "Dashboard")
@section("header", "Dashboard")

{{-- Css Styling --}}
@push ("css-libs")
    {{-- Memastikan Boxicons dimuat untuk ikon --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Tambahkan styling khusus di sini jika diperlukan */
        .whatsapp-icon-link {
            display: inline-flex; /* Menggunakan flexbox untuk penataan ikon */
            align-items: center;
            justify-content: center;
            width: 24px; /* Ukuran ikon lebih kecil agar pas di samping teks */
            height: 24px;
            border-radius: 50%; /* Membuat ikon lingkaran */
            background-color: #25d366; /* Warna latar belakang WhatsApp */
            color: white; /* Warna ikon */
            font-size: 14px; /* Ukuran font ikon */
            text-decoration: none;
            transition: background-color 0.3s ease; /* Efek transisi saat hover */
            margin-left: 8px; /* Jarak antara teks dan ikon */
            vertical-align: middle; /* Pastikan ikon sejajar dengan teks */
            flex-shrink: 0; /* Mencegah ikon menyusut pada layar kecil */
        }
        .whatsapp-icon-link:hover {
            background-color: #1da851; /* Warna saat hover */
        }
        .whatsapp-icon-link i {
            line-height: 1; /* Mengatur tinggi baris agar ikon di tengah */
        }
        /* Style untuk status */
        .status {
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
        }

        .status.pending {
            background-color: #ffc107;
        }

        .status.completed {
            background-color: #28a745; 
        }

        /* Responsive table styles */
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            thead {
                display: none;
            }
            tr {
                display: block;
                margin-bottom: 10px;
                border: 1px solid #ddd;
                border-radius: 8px;
            }
            td {
                display: flex;
                justify-content: space-between;
                padding: 8px 12px;
                border-bottom: 1px solid #eee;
            }
            td:last-child {
                border-bottom: none;
            }
            td::before {
                content: attr(data-label);
                font-weight: bold;
                flex-basis: 50%;
            }
        }
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


<!-- Insights -->
    <ul class="insights">
        <li>
            <i class='bx bx-book'></i>
            <span class="info">
                <h3>
                    {{ $bukuTotal }}
                </h3>
                <p>Total Buku</p>
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

        <li>
            <i class='bx bx-group'></i>
            <span class="info">
                <h3>
                    {{ $anggotas }}
                </h3>
                <p>Total Anggota</p>
            </span>
        </li>

    </ul>
    <!-- End of Insights -->

    <div class="bottom-data">

        <div class="orders">
            <div class="header">
                <i class='bx bx-receipt'></i>
                <h3>Transaksi Terakhir </h3>
                <i class='bx bx-filter d-none'></i>
                <i class='bx bx-search d-none'></i>
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
                    @foreach ($transaksi as $data)
                        <tr>
                            <td data-label="Nama Anggota">
                                <p>{{ $data['nama_anggota'] }}</p>
                            </td>

                            <td data-label="Tanggal Pinjam"> <p>{{ $data['tanggal_transaksi'] }}</p></td>
                            
                            <td data-label="Status">
                                @php
                                    $statusClass = '';
                                    if ($data['tipe_transaksi'] == 'Peminjaman') {
                                        $statusClass = 'pending';
                                    } elseif ($data['tipe_transaksi'] == 'Pengembalian') {
                                        $statusClass = 'completed';
                                    }
                                @endphp
                                <span class="status {{ $statusClass }}">{{ $data['tipe_transaksi'] }}</span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Reminders -->
        <div class="reminders">
            <div class="header">
                <i class='bx bx-note'></i>
                <h3>Pengingat</h3>
                <i class='bx bx-filter d-none'></i>
                <i class='bx bx-search d-none'></i>
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
                    @foreach ($pengingat as $data)
                        <tr>
                            <td data-label="Nama">
                                <p>{{ $data['nama_anggota'] }}</p>
                            </td>
                            <td data-label="Tgl Pinjam">{{ $data['tanggal_pinjam'] }}</td>
                            <td data-label="Jatuh Tempo">
                                <span style="display: inline-flex; align-items: center;">
                                    {{ $data['jatuh_tempo'] }}
                                    @php
                                        // menghapus nomor dari +
                                        $phoneNumber = preg_replace('/[^0-9]/', '', $data['no_telepon'] ?? '');

                                        // mengubah +62 menjadi 62
                                        if (substr($phoneNumber, 0, 1) === '0') {
                                            $phoneNumber = '62' . substr($phoneNumber, 1);
                                        }

                                        $memberName = $data['nama_anggota'];
                                        $dueDate = $data['jatuh_tempo'];
                                        $message = "Halo " . $memberName . ", kami ingin mengingatkan bahwa ada buku yang Anda pinjam dengan jatuh tempo pada tanggal " . $dueDate . ". Mohon segera dikembalikan ya. Terima kasih!";
                                        $encodedMessage = urlencode($message);
                                        $whatsappUrl = "https://wa.me/" . $phoneNumber . "?text=" . $encodedMessage;
                                    @endphp

                                    @if (!empty($phoneNumber) && strlen($phoneNumber) >= 8)
                                        <a href="{{ $whatsappUrl }}" target="_blank" class="whatsapp-icon-link" title="Kirim Pengingat WhatsApp ke {{ $memberName }}">
                                            <i class='bx bxl-whatsapp'></i>
                                        </a>
                                    @else
                                        <span class="text-muted" title="Nomor WhatsApp tidak tersedia">- Tidak Tersedia -</span>
                                    @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- End of Reminders-->

    </div>
@endsection
