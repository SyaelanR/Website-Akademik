<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwals';
    protected $primaryKey = 'id_jadwal';
    protected $fillable = [
        'id_sekolah',
        'id_kelas',
        'id_mapel',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'semester',
        'tingkat',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Clien::class, 'id_sekolah', 'id_sekolah');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
}