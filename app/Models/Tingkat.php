<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    protected $table = 'tingkats';
    protected $primaryKey = 'id_tingkat';
    protected $fillable = ['tingkat', 'id_sekolah'];
}
