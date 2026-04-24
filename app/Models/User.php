<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nisn_nik',
        'alamat',
        'role',
        'id_kelas',
        'id_angkatan',
        'jenis_kelamin',
        'username',
        'id_sekolah',
        'no_telp',
        'tempat_lahir',
        'tanggal_lahir',
        'usia',
        'tanggal_masuk',
        'tanggal_lulus',
        'nama_orang_tua',
        'gaji_orang_tua',
        'jumlah_sodara',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'encrypted',
            'nisn_nik' => 'encrypted',
        ];
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id_kelas');
    }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class, 'id_angkatan', 'id_angkatan');
    }

    public function sekolah()
    {
        return $this->belongsTo(Clien::class, 'id_sekolah', 'id_sekolah');
    }

    public function daftarNilaiSiswa ()
    {
        return $this->hasMany(DaftarNilaiSiswa::class, 'id_siswa', 'id');
    }

    public function daftarAbsensiSiswa ()
    {
        return $this->hasMany(DaftarAbsensiSiswa::class, 'id_siswa', 'id');
    }



    
}