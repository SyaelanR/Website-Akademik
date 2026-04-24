<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmabayaranSiswa extends Model
{
    protected $table = 'pmabayaran_siswas';
    protected $primaryKey = 'id_pembayaran_siswa';
    protected $fillable = [
        'id_siswa',
        'id_sekolah',
        'id_daftar_tagihan',
        'jumlah_tagihan',
        'status_pembayaran',
    ];
}
