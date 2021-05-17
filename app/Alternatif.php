<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Nilai;

class Alternatif extends Model
{
    public $timestamps = false;



    protected $fillable = [
        'idKasus', 'namaAlternatif'
    ];

    public function nilai(){
        return $this->hasMany(Nilai::class, 'idAlternatif', 'id');
    }

}
