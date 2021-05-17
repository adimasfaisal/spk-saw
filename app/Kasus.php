<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasus extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'namaKasus'
    ];
}
