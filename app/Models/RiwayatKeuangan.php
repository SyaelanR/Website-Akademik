<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKeuangan extends Model
{
    protected $table = 'riwayat_keuangans';
    protected $primaryKey = 'id_riwayat_keuangan';
    protected $fillable = [
        'id_sekolah',
        'tanggal',
        'jenis',
        'jumlah',
        'keterangan',
        'saldo',
    ];
}
