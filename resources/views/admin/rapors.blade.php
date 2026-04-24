<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale-1.0">
    <title>Rapor Pencapaian Ketuntasan Belajar</title>
    <link rel="icon" type="image/png" href="{{ asset('asset/school-solid-full.png') }}">
    <style>
        /* Gaya untuk dicetak */
        @page {
            size: A4;
            margin: 10mm; /* Atur margin agar lebih rapi saat dicetak */
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11pt;
            margin: 0;
            padding: 0;
            line-height: 1.5;
            color: #000;
            background-color: #f4f4f4; /* Latar belakang abu-abu untuk mode non-cetak */
        }

        .page-break {
            page-break-after: always;
            clear: both;
        }

        .container {
            width: 190mm; /* Lebar A4 untuk desktop */
            max-width: 100%; /* Pastikan tidak melebihi lebar layar */
            margin: 20px auto; /* Memberi jarak atas/bawah */
            background-color: #fff; /* Latar belakang putih untuk kertas rapor */
            padding: 15mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Efek bayangan */
            box-sizing: border-box;
        }

        /* Penyesuaian untuk layar kecil (mobile) */
        @media (max-width: 768px) {
            .container {
                padding: 10mm 5mm; /* Kurangi padding di mobile */
            }
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .header h3, .header h4 {
            margin: 0;
            padding: 0;
        }

        /* Data Siswa */
        .data-siswa {
            width: 100%;
            margin-bottom: 5px;
        }
        .data-siswa table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-siswa td:first-child {
            width: 25%;
            padding-right: 10px;
        }
        .data-siswa td:nth-child(2) {
            width: 5%;
        }

        /* Tabel Nilai */
        .tabel-nilai {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .tabel-nilai th, .tabel-nilai td {
            border: 1px solid #000;
            padding: 4px;
            text-align: center;
            vertical-align: middle;
            font-size: 10pt;
        }
        .tabel-nilai th {
            font-weight: bold;
            background-color: #f0f0f0; /* Opsional: memberikan sedikit latar belakang pada header */
        }
        .tabel-nilai .text-left {
            text-align: left;
            padding-left: 5px;
        }
        .tabel-nilai .footer-row td {
            font-weight: bold;
        }

        /* Keterangan Absensi */
        .keterangan-absensi {
            margin-top: 20px;
            font-size: 10pt;
        }
        .keterangan-absensi .kiri {
            float: left;
            width: 45%;
        }
        
        /* Tanda Tangan */
        .tanda-tangan {
            margin-top: 30px;
            width: 100%;
        }
        .tanda-tangan .kiri-tt {
            float: left;
            width: 45%;
            text-align: left;
        }
        .tanda-tangan .kanan-tt {
            float: right;
            width: 45%;
            text-align: right;
        }
        .tanda-tangan .spacer {
            height: 60px; /* Ruang untuk tanda tangan */
        }

        /* Tombol Aksi */
        .action-buttons {
            padding: 15px;
            text-align: center;
            background-color: #333;
        }
        .action-buttons button, .action-buttons a {
            font-family: Arial, sans-serif;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            margin: 0 10px;
            font-size: 14px;
        }
        .btn-back { background-color: #6c757d; }
        .btn-back:hover { background-color: #5a6268; }
        .btn-export { background-color: #c82333; }
        .btn-export:hover { background-color: #bd2130; }

        /* Utility */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Gaya untuk media cetak */
        @media print {
            body {
                background-color: #fff;
            }
            .container {
                margin: 0;
                box-shadow: none;
                padding: 0;
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

    @foreach ($processedRapors as $index => $data)
        <div class="container">
            <div class="header">
                <h3>FORMAT PENCAPAIAN KETUNTASAN BELAJAR</h3>
                <h4>BERDASARKAN NILAI AKHIR (RAPOR)</h4>
                <h4>TAHUN PELAJARAN {{ $kelasInfo->angkatan->angkatan ?? 'N/A' }}</h4>
            </div>

            <!-- Data Siswa dan Sekolah -->
            <div class="data-siswa">
                <table>
                    <tr>
                        <td>NAMA SISWA</td>
                        <td>:</td>
                        <td><strong>{{ strtoupper($data['siswa']->name) }}</strong></td>
                        <td style="width: 20%;">NISN</td>
                        <td>:</td>
                        <td>{{ $data['siswa']->nisn_nik }}</td>
                    </tr>
                    <tr>
                        <td>TINGKAT</td>
                        <td>:</td>
                        <td>{{ $infoTS->idTingkat->tingkat ?? 'N/A'}}</td>
                        <td>SEMESTER</td>
                        <td>:</td>
                        <td>{{ ucfirst($infoTS->semester ?? 'N/A') }}</td>
                    </tr>
                    <tr>
                        <td>SEKOLAH</td>
                        <td>:</td>
                        <td colspan="4">{{$kelasInfo->angkatan->sekolah->nama_sekolah ?? 'N/A'}}</td> {{-- Ganti dengan data sekolah dinamis jika ada --}}
                    </tr>
                </table>
            </div>

            <!-- Tabel Nilai Utama -->
            <table class="tabel-nilai">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 5%;">No. <br></th>
                        <th rowspan="2" style="width: 25%;">Mata Pelajaran <br></th>
                        <th colspan="4">Nilai Hasil Belajar</th>
                        <th rowspan="2" style="width: 15%;">Keterangan <br></th>
                    </tr>
                    <tr>
                        <th style="width: 8%;">Tugas <br></th>
                        <th style="width: 8%;">UTS <br></th>
                        <th style="width: 8%;">UAS <br></th>
                        <th style="width: 8%; font-weight: bold; background-color: #e0e0e0;">Nilai Akhir <br></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalTugas = 0;
                        $totalUTS = 0;
                        $totalUAS = 0;
                        $totalNilaiAkhir = 0;
                        $mapelCount = $data['rapor']->count();
                    @endphp

                    @forelse ($data['rapor'] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-left">{{ $item['mapel']->nama_mapel ?? 'N/A' }}</td>
                            <td>{{ $item['scores']['Tugas'] ?? '-' }}</td>
                            <td>{{ $item['scores']['UTS'] ?? '-' }}</td>
                            <td>{{ $item['scores']['UAS'] ?? '-' }}</td>
                            <td>{{ $item['scores']['Nilai Akhir'] ?? '-' }}</td>
                            <td>{{ ($item['scores']['Nilai Akhir'] ?? 0) >= 75 ? 'Tuntas' : 'Belum Tuntas' }}</td>
                        </tr>
                        @php
                            $totalTugas += $item['scores']['Tugas'] ?? 0;
                            $totalUTS += $item['scores']['UTS'] ?? 0;
                            $totalUAS += $item['scores']['UAS'] ?? 0;
                            $totalNilaiAkhir += $item['scores']['Nilai Akhir'] ?? 0;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="7">Tidak ada data nilai untuk ditampilkan.</td>
                        </tr>
                    @endforelse

                    <!-- Baris Jumlah -->
                    <tr class="footer-row">
                        <td colspan="2" class="text-left">Jumlah</td>
                        <td>{{ $totalTugas }}</td>
                        <td>{{ $totalUTS }}</td>
                        <td>{{ $totalUAS }}</td>
                        <td>{{ $totalNilaiAkhir }}</td>
                        <td></td>
                    </tr>
                    <!-- Baris Rata-rata -->
                    <tr class="footer-row">
                        <td colspan="2" class="text-left">Rata-rata</td>
                        <td>{{ $mapelCount > 0 ? round($totalTugas / $mapelCount) : 0 }}</td>
                        <td>{{ $mapelCount > 0 ? round($totalUTS / $mapelCount) : 0 }}</td>
                        <td>{{ $mapelCount > 0 ? round($totalUAS / $mapelCount) : 0 }}</td>
                        <td>{{ $mapelCount > 0 ? round($totalNilaiAkhir / $mapelCount) : 0 }}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <!-- Keterangan Absensi dan TTD -->
            <div class="clearfix" style="margin-top: 20px;">
                <div class="kiri">
                    <p><strong>Ketidakhadiran</strong></p>
                    <table>
                        <tr><td>Izin</td><td>:</td><td>{{ $data['absensi']['Izin'] ?? 0 }} hari</td></tr>
                        <tr><td>Sakit</td><td>:</td><td>{{ $data['absensi']['Sakit'] ?? 0 }} hari</td></tr>
                        <tr><td>Tanpa Keterangan (Alfa)</td><td>:</td><td>{{ $data['absensi']['Alfa'] ?? 0 }} hari</td></tr>
                    </table>
                </div>
            </div>

            <div class="tanda-tangan clearfix">
                <div class="kiri-tt">
                    <p>Mengetahui,</p>
                    <p>Orang Tua/Wali</p>
                    <div class="spacer"></div>
                    <p>(................................)</p>
                </div>
                <div class="kanan-tt">
                    <p>{{$kelasInfo->angkatan->sekolah->alamat ?? 'N/A'}}, {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</p>
                    <p>Wali Kelas</p>
                    <div class="spacer"></div>
                    <p><strong>{{ $kelasInfo->wali_kelas ?? '(................................)' }}</strong></p>
                </div>
            </div>
        </div>

        {{-- Jangan tambahkan page-break setelah item terakhir --}}
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html>
