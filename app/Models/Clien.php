<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clien extends Model
{
    // protected $table = 'cliens'; gunakan jika nama tabel tidak sesuai dengan nama model (jamak)
    protected $primaryKey = 'id_sekolah';
    protected $fillable = ['
        id_sekolah',
        'nama_sekolah',
        'email',
        'alamat',
        'no_telp',
        'status'
];

public function kelas(){
    return $this->hasMany(Kelas::class, 'id_sekolah', 'id_sekolah');
}

public function users(){
    return $this->hasMany(User::class, 'id_sekolah', 'id_sekolah');
}


public function acara(){
    return $this->hasMany(DaftarAcara::class, 'id_sekolah', 'id_sekolah');
}
    
}
