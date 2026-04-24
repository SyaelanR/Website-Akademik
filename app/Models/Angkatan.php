<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    // protected $table = 'angkatan';
    protected $primaryKey = 'id_angkatan';
    protected $fillable = [
        'id_angkatan',
        'angkatan',
        'id_sekolah',
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
        'id_tingkat',
        'tingkat',
        'is_alumni'
];

    public function sekolah()
    {
        return $this->belongsTo(Clien::class, 'id_sekolah', 'id_sekolah');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_angkatan', 'id_angkatan');
    }

    public function idTingkat()
    {
        return $this->belongsTo(Tingkat::class, 'id_tingkat', 'id_tingkat');
    }

}
