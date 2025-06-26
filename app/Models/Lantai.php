<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lantai extends Model
{
    protected $table = 'lantais'; 

    protected $fillable = [
        'nama_lantai',
    ];
}
