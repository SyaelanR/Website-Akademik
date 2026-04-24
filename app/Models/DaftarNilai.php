<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarNilai extends Model
{
    protected $table = 'daftar_nilais';
    protected $primaryKey = 'id_daftar_nilai';
    protected $fillable = [
        'id_mapel',
        'tipe_nilai',
        'keterangan',
        'tanggal',
        'id_sekolah',
        'tingkat',
        'semester',
        'id_kelas',
        'sifat',
        'id_daftar_tugas',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function tugas()
    {
        return $this->belongsTo(DaftarTugas::class, 'id_daftar_tugas', 'id_daftar_tugas');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }
}
