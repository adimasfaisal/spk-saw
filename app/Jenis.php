<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'jenis'
    ];
}
