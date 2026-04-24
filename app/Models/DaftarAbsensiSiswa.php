<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarAbsensiSiswa extends Model
{
    
    protected $table = 'daftar_absensi_siswas';
    protected $primaryKey = 'id_daftar_absensi_siswa';
    protected $fillable = [
        'id_siswa',
        'id_daftar_absensi',
        'id_sekolah',
        'id_kelas',
        'id_mapel',
        'tingkat',
        'semester',
        'status',
    ];

    function siswa()
    {
        return $this->belongsTo(User::class, 'id_siswa', 'id');
    }

    function daftarAbsensi()
    {
        return $this->belongsTo(DaftarAbsensi::class, 'id_daftar_absensi', 'id_daftar_absensi');
    }

    function sekolah()
    {
        return $this->belongsTo(Clien::class, 'id_sekolah', 'id_sekolah');
    }

    function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    function idTingkat()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat', 'id_tingkat');
    }

}
