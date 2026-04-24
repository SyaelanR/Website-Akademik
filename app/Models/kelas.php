<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'id_kelas',
        'nama_kelas',
        'id_angkatan',
        'id_sekolah',
        'jurusan',
        'wali_kelas',
    ];  

    protected $primaryKey = 'id_kelas';
    protected $table = 'kelas';

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatan', 'id_angkatan');
    }

    public function sekolah()
    {
        return $this->belongsTo(User::class, 'id_sekolah', 'id_sekolah');
    }
}