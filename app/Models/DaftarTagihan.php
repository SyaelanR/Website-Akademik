<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarTagihan extends Model
{
    protected $table = 'daftar_tagihans';
    protected $primaryKey = 'id_daftar_tagihan';
    protected $fillable = [
        'id_sekolah',
        'jumlah_tagihan',
        'keterangan',
        'jatuh_tempo',
        'target_angkatan',
        'persentase_terbayar',
        'nama_angkatan',
    ];
}
