<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarPengumuman extends Model
{
    protected $table = 'daftar_pengumuman';

    protected $fillable = ['id_sekolah', 'id_kelas', 'id_mapel', 'judul', 'isi'];

    public function sekolah ()
    {
        return $this->belongsTo(Clien::class, 'id_sekolah', 'id_sekolah');
    }

    public function kelas ()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mapel ()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
}
