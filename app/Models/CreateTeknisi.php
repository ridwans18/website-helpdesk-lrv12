<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CreateTeknisi extends Model
{
    protected $table = 'createteknisis'; 

    protected $fillable = [
        'nama_teknisi',
    ];
}
