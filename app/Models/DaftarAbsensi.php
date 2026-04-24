<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarAbsensi extends Model
{
    protected $table = 'daftar_absensis';
    protected $primaryKey = 'id_daftar_absensi';
    protected $fillable = [
        'id_sekolah',
        'id_kelas',
        'id_mapel',
        'tingkat',
        'semester',
        'tanggal',
        'keterangan',
        'kategori',
    ];

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
}
