<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'idKasus', 'idAlternatif', 'idKriteria', 'nilai'
    ];
}
