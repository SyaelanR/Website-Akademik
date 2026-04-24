<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarAcara extends Model
{
    protected $table ='daftar_acaras';

    protected $fillable = [
        'id_sekolah',
        'judul_acara',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'peserta',
        'deskripsi',
    ];

    public function sekolah ()
    {
        return $this->belongsTo(Clien::class, 'id_sekolah', 'id_sekolah');
    }
}
