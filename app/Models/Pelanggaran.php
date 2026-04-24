<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pelanggarans';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_pelanggaran';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_sekolah',
        'id_siswa',
        'id_kelas',
        'jenis_pelanggaran',
        'keterangan',
        'poin',
        'tanggal',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_siswa', 'id');
    }
}
