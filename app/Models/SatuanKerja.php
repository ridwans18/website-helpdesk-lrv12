<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SatuanKerja extends Model
{
    protected $table = 'satuan_kerjas'; 

    protected $fillable = [
        'nama_satuankerja',
    ];
}
