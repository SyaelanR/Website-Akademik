<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Rencana Studi</title>
    <link rel="icon" type="image/png" href="{{ asset('asset/school-solid-full.png') }}">
    <style>
        /* Gaya dasar untuk tampilan browser */
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            background-color: #e9e9e9;
            margin: 0;
            padding: 0;
            color: #000;
        }

        /* Kontainer utama kartu */
        .card-container {
            width: 210mm; /* Ukuran A4 */
            margin: 20px auto;
            background-color: #fff;
            padding: 20mm;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            box-sizing: border-box;
            position: relative;
        }
        
        .content-wrapper {
            position: relative;
            z-index: 2;
        }
        
        /* Header */
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h3 {
            margin: 0;
            font-size: 16pt;
            font-weight: bold;
        }

        /* Informasi Siswa */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11pt;
        }
        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .info-table td:nth-child(1) { width: 15%; }
        .info-table td:nth-child(2) { width: 2%; }
        .info-table td:nth-child(3) { width: 33%; }
        .info-table td:nth-child(4) { width: 20%; }
        .info-table td:nth-child(5) { width: 2%; }
        .info-table td:nth-child(6) { width: 28%; }

        /* Tabel Mata Pelajaran */
        .mapel-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11pt;
        }
        .mapel-table th, .mapel-table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        .mapel-table th {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .mapel-table td.text-left {
            text-align: left;
        }
        .mapel-table .footer-row td {
            font-weight: bold;
            text-align: right;
            padding-right: 10px;
        }
        .mapel-table .footer-row td:first-child {
            text-align: center;
        }

        /* Bagian Tanda Tangan */
        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
            font-size: 11pt;
        }
        .signature-section .left {
            width: 20%;
            text-align: center;
        }
        .signature-section .right {
            width: 75%;
            display: flex;
            justify-content: space-between;
        }
        .signature-section .signature-box {
            text-align: center;
        }
        .signature-section .spacer {
            height: 70px;
        }
        .signature-section .nama {
            font-weight: bold;
            text-decoration: underline;
        }
        
        /* Tombol Aksi */
        .action-buttons {
            padding: 15px;
            text-align: center;
            background-color: #2c3e50;
        }
        .action-buttons button, .action-buttons a {
            font-family: Arial, sans-serif;
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            margin: 0 10px;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .btn-back { background-color: #7f8c8d; }
        .btn-back:hover { background-color: #95a5a6; }
        .btn-export { background-color: #c0392b; }
        .btn-export:hover { background-color: #e74c3c; }

        /* Gaya untuk media cetak */
        @media print {
            body {
                background-color: #fff;
            }
            .card-container {
                margin: 0;
                box-shadow: none;
                padding: 10mm;
                height: auto; /* Memastikan tinggi sesuai konten */
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Tombol Aksi (Tidak akan dicetak) -->
    <div class="action-buttons no-print">
        <a href="{{ url()->previous() }}" class="btn-back">
            <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>Kembali
        </a>
        <button onclick="window.print()" class="btn-export">
            <i class="fas fa-file-pdf" style="margin-right: 8px;"></i>Export / Print
        </button>
    </div>

    <div class="card-container">
        <div class="content-wrapper">
            <div class="header">
                <h3>KARTU RENCANA STUDI</h3>
            </div>

            <!-- Informasi Siswa -->
            <table class="info-table">
                <tr>
                    <td>Nama Siswa</td>
                    <td>:</td>
                    <td><strong>{{ $user->name}}</strong></td>
                    <td>Wali Kelas</td>
                    <td>:</td>
                    <td>{{$waliKelas}}</td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>:</td>
                    <td>1234567890</td>
                    <td>Tingkat</td>
                    <td>:</td>
                    <td>{{$tingkat}}</td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td>:</td>
                    <td>{{$sekolah}}</td>
                    <td>Semester</td>
                    <td>:</td>
                    <td>{{$semester}}</td>
                </tr>
            </table>

            <!-- Tabel Mata Pelajaran -->
            <table class="mapel-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 15%;">Kode Mapel</th>
                        <th>Mata Pelajaran</th>
                        <th style="width: 10%;">SKS</th>
                        <th colspan="2" style="width: 20%;">Paraf Pengawas</th>
                    </tr>
                    <tr>
                        <th colspan="4"></th>
                        <th style="font-size: 10pt;">UTS</th>
                        <th style="font-size: 10pt;">UAS</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contoh Data Mata Pelajaran (Loop di sini) -->
                    @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$jadwal->mapel->kode_mapel}}</td>
                        <td class="text-left">{{$jadwal->mapel->nama_mapel}}</td>
                        <td>{{$jadwal->mapel->sks}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                    <!-- Akhir Loop -->

                    <!-- Baris Kosong untuk mengisi sisa halaman jika perlu -->
                    @for ($i = 0; $i < 3; $i++)
                    <tr>
                        <td>&nbsp;</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endfor
                    
                    <!-- Baris Jumlah SKS -->
                    <tr class="footer-row">
                        <td colspan="3">Jumlah SKS</td>
                        <td>{{$jumlahSKS}}</td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>

            <!-- Tanda Tangan & QR Code -->
            <div class="signature-section">
                {{-- <div class="left">
                    <!-- Ganti dengan QR Code dinamis jika ada -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=NAMA-SISWA-1234567890" alt="QR Code">
                </div> --}}
                <div class="right">
                    <div class="signature-box">
                        <p>Mengetahui,</p>
                        <p>Wali Kelas</p>
                        <div class="spacer"></div>
                        <p class="nama">{{$waliKelas}}</p>
                    </div>
                    <div class="signature-box">
                        <p>Surakarta, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</p>
                        <p>Siswa</p>
                        <div class="spacer"></div>
                        <p class="nama">{{$user->name}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Font Awesome (untuk ikon di tombol) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html>

