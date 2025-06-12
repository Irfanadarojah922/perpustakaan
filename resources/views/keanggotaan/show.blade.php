<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profil Mahasiswa</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #e8e8e8;
      margin: 0;
      padding: 0;
    }

    .background {
      background: url({{ asset( 'assets/image.jpg' )}}) no-repeat center;
      background-size: cover;
      height: 300px;
      position: relative;
    }

    .container {
      max-width: 850px;
      margin: -200px auto 0;
      background: #fff;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      border-radius: 10px;
      overflow: hidden;
      display: flex;
      flex-direction: row;
      padding: 30px;
      position: relative;
      z-index: 10;
    }

    .left {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding-right: 20px;
      border-right: 1px solid #ddd;
    }

    .left img {
      width: 160px;
      height: 160px;
      object-fit: cover;
      border-radius: 50%;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .right {
      flex: 2;
      padding-left: 30px;
    }

    .halo {
      background: #007bff;
      color: #fff;
      display: inline-block;
      padding: 5px 12px;
      border-radius: 5px;
      font-weight: bold;
      margin-bottom: 10px;
    }

    h2 {
      margin: 0;
    }

    .subtitle {
      color: #555;
      margin-bottom: 20px;
    }

    .info-table {
      width: 100%;
      font-size: 15px;
    }

    .info-table td {
      padding: 6px 10px;
      vertical-align: top;
    }

    .info-table td:first-child {
      font-weight: bold;
      width: 140px;
      color: #444;
    }

    .badge {
      background-color: #007bff;
      color: white;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 13px;
      display: inline-block;
      margin-top: 15px;
    }

    .footer {
      text-align: center;
      padding: 15px;
      background: #007bff;
      color: white;
      font-size: 14px;
      margin-top: 30px;
      border-radius: 0 0 10px 10px;
    }

    .footer a {
      color: white;
      margin: 0 10px;
      text-decoration: none;
    }

    .footer i {
      margin-right: 5px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        padding: 20px;
        margin: -60px 20px 0;
      }
      .left {
        border-right: none;
        padding-right: 0;
        margin-bottom: 20px;
      }
      .right {
        padding-left: 0;
      }
    }
  </style>
</head>
<body>
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="wrapper">
        <div class="background"></div>
        <div class="container">
            <div class="left">
            <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto Anggota" />

            </div>
            <div class="right">
            <div class="halo">HALO!</div>
            <h2>{{ $anggota->name }}</h2>
            <div class="subtitle"> {{ $anggota->status }} </div>
            <table class="info-table">
                <tr>
                    <td>No NIK</td>
                    <td>{{ $anggota->nik }}</td>
                </tr>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>{{ $anggota->nama }}</td>
                </tr>

                <tr>
                    <td>Tempat Lahir</td>
                    <td>{{ $anggota->tempat_lahir }}</td>
                </tr>
                <tr>
                    <td>Tanggal Lahir</td>
                    <td>{{ $anggota->tanggal_lahir }}</td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>{{ $anggota->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td>{{ $anggota->pendidikan }}</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>{{ $anggota->alamat}}</td>
                </tr>
                <tr>
                    <td>No Telepon</td>
                    <td>{{ $anggota->no_telepon }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $anggota->status }}</td>
                </tr>
                <tr>
                    <td>Tanggal Daftar</td>
                    <td>{{ $anggota->tanggal_daftar }}</td>
                </tr>
            </table>

            </div>
        </div>

  <div class="footer">&copy; 2025 Tugas Akhir Irfa'na Darojah Politeknik Baja Kab Tegal</div>
</body>
</html>
