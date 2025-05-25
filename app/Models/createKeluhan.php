<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class createKeluhan extends Model
{
    protected $table = 'createkeluhans';

    protected $fillable = [
        'keluhan',
        'nip',
        'nik',
        'nama_pelapor',
        'jabatan',
        'kategori',
        'teknisi',
        'notadinas',
        'satuankerja',
        'lantai',
        'rincian',
        'status',
    ];
}
