<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarKurikulum extends Model
{
    protected $table = 'daftar_kurikulums';

    protected $primaryKey = 'id_kurikulum';

    protected $fillable = [
        'id_sekolah',
        'id_angkatan',
        'nama_kurikulum',
        'jenjang',
        'jumlah_matpel',
        'status',
    ];

    public function sekolah (){
        return $this->belongsTo(Clien::class,'id_sekolah', 'id_sekolah');
    }

    public function angkatan (){
        return $this->belongsTo(Angkatan::class,'id_angkatan', 'id_angkatan');
    }
}
