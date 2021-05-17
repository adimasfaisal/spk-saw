<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kriterias')->insert([
        [
            'namaKriteria' => 'Lokasi',
            'bobot' => 0.3,
            'idJenis' => 1
        ],
        [
            'namaKriteria' => 'Biaya Hidup',
            'bobot' => 0.2,
            'idJenis' => 2
        ], 
        [
            'namaKriteria' => 'Fasilitas Publik',
            'bobot' => 0.3,
            'idJenis' => 1
        ],
        [
            'namaKriteria' => 'Akses Transportasi',
            'bobot' => 0.2,
            'idJenis' => 1
        ]
        ]);
    }
}
