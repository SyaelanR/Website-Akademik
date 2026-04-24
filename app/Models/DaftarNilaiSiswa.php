<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarNilaiSiswa extends Model
{
    
    protected $table = 'daftar_nilai_siswas';
    protected $primaryKey = 'id_daftar_nilai_siswa';
    protected $fillable = [
        'id_siswa',
        'id_daftar_nilai',
        'id_sekolah',
        'id_kelas',
        'id_mapel',
        'tingkat',
        'semester',
        'nilai',
        'nama_fileTugas',
    ];
    
    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_siswa', 'id');
    }

    public function daftarNilai()
    {
        return $this->belongsTo(DaftarNilai::class, 'id_daftar_nilai', 'id_daftar_nilai');
    }

    public function sekolah()
    {
        return $this->belongsTo(Clien::class, 'id_sekolah', 'id_sekolah');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function idTingkat()
    {
        return $this->belongsTo(Tingkat::class, 'tingkat', 'id_tingkat');
    }

}
