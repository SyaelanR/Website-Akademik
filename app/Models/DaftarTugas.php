<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarTugas extends Model
{
    protected $table = 'daftar_tugas';
    protected $primaryKey = 'id_daftar_tugas';

    protected $fillable = [
        'id_sekolah', 
        'id_kelas', 
        'id_mapel',
        'tingkat', 
        'semester', 
        'deadline', 
        'keterangan', 
        'nama_file'
    ];

    public function sekolah(){
        return $this->belongsTo(Clien::class, 'id_sekolah', 'id_sekolah');
    
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    
    }

    public function mapel(){
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    
    }

}
