<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'namaKriteria', 'bobot', 'idJenis'
    ];
}
