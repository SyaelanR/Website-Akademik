<?php

namespace App\Exports;

use App\Models\DaftarNilaiSiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanNilaiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $id_kelas;
    protected $id_mapel;
    protected $id_tingkat;
    protected $semester;

    // 2. Terima dua parameter di constructor
    public function __construct(int $id_kelas, int $id_mapel, int $id_tingkat, string $semester)
    {
        $this->id_kelas = $id_kelas;
        $this->id_mapel = $id_mapel;
        $this->id_tingkat = $id_tingkat;
        $this->semester = $semester;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Gunakan parameter dari constructor untuk filter dinamis
        // dan tambahkan eager loading untuk 'daftarNilai' untuk menghindari N+1 problem
        return DaftarNilaiSiswa::with(['siswa', 'mapel', 'kelas', 'daftarNilai'])
            ->where('id_kelas', $this->id_kelas)
            ->where('id_mapel', $this->id_mapel)
            ->where('tingkat', $this->id_tingkat)
            ->where('semester', $this->semester)
            ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Definisikan nama-nama kolom di file Excel
        return [
            'NISN',
            'Nama Siswa',
            'Tipe Nilai',
            'Keterangan',
            'tanggal',
            'Nilai',
        ];
    }

    /**
     * @param mixed $nilai // $nilai adalah satu item dari collection()
     * @return array
     */
    public function map($nilai): array
    {
        // Transformasi setiap baris data sesuai dengan urutan di headings()
        return [
            $nilai->siswa->nisn_nik,
            $nilai->siswa->name,
            $nilai->daftarNilai->tipe_nilai, // Asumsi relasi ke daftar_nilai
            $nilai->daftarNilai->keterangan, // Asumsi relasi ke daftar_nilai
            $nilai->daftarNilai->tanggal, 
            $nilai->nilai,
        ];
    }
}
