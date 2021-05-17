<?php

namespace App\Http\Controllers;

use App\Alternatif;
use App\Jenis;
use App\Kasus;
use App\Kriteria;
use App\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idKasus = $request->idKasus;
        $idAlternatif = $request->idAlternatif;
        $idKriteria = $request->idKriteria;
        $nilai = $request->nilai;

        for ($i=0; $i < count($nilai); $i++) { 
            $data[$i]['idKasus'] = $idKasus; 
            $data[$i]['idAlternatif'] = $idAlternatif; 
            $data[$i]['idKriteria'] = $idKriteria[$i]; 
            $data[$i]['nilai'] = $nilai[$i]; 
        }
        
        for ($j=0; $j < count($data); $j++) { 
            Nilai::create($data[$j]);
        }

        return back();
    }

    public function hitung($id){
        $kasus = Kasus::where('id', $id)->first();
        $nilai = Nilai::where('idKasus', $id)->get();
        $max = count($nilai);
        $alternate = Alternatif::where('idKasus', $id)->get();
        $maxa = count($alternate);
        $kriteria = Kriteria::all();

        for ($j=0; $j < $maxa; $j++) { 
            for ($i=0; $i < $max; $i++) { 
                $data[$i]['idKasus'] = $id;
                $data[$i]['idAlternatif'] = $nilai[$i]['idAlternatif'];
                $data[$i]['alternatif'] = Alternatif::where('id', $data[$i]['idAlternatif'])->pluck('namaAlternatif')->first();
                $data[$i]['idKriteria'] = $nilai[$i]['idKriteria'];
                $data[$i]['nilai'] = $nilai[$i]['nilai'];
                $krit = Kriteria::where('id', $data[$i]['idKriteria'])->first();
                $jenis = Jenis::where('id', $krit['idJenis'])->first();
                $data[$i]['bobot'] = Kriteria::where('id', $data[$i]['idKriteria'])->pluck('bobot')->first();
                $data[$i]['jenis'] = $jenis->id;
                $data[$i]['max'] = Nilai::where([
                    'idKasus' => $data[$i]['idKasus'],
                    'idKriteria' => $data[$i]['idKriteria']
                ])->max('nilai');
                $data[$i]['min'] = Nilai::where([
                    'idKasus' => $data[$i]['idKasus'],
                    'idKriteria' => $data[$i]['idKriteria']
                ])->min('nilai');
    
                if ($data[$i]['jenis'] == 1) {
                    $data[$i]['normalisasi'] = $data[$i]['nilai'] / $data[$i]['max'];
                } else {
                    $data[$i]['normalisasi'] = $data[$i]['min'] / $data[$i]['nilai'] ;
                }
            }
        }

        $maxd = count($data);
        $maxk = count($kriteria);

        for ($k=0; $k < $maxa; $k++) { 
            $hasil[$k]['idKasus'] = $id;
            $hasil[$k]['idAlternatif'] = $alternate[$k]['id'];
            $hasil[$k]['alternatif'] = $alternate[$k]['namaAlternatif']; 
            $bobot = $data[$k]['bobot'];
            $normalisasi = $data[$k]['normalisasi'];
            $hasil[$k]['hasil'] = $bobot * $normalisasi;            
        }

        $res = max(array_column($hasil, 'hasil'));
        
        $result['alt'] = [];
        foreach ($hasil as $h) {
            if ($h['hasil'] == $res) {
                $result['value'] = $h['hasil'] ;
                array_push($result['alt'], $h['alternatif']) ;
            }
        }

        return view('hitung')->with(compact('data', 'alternate', 'kriteria', 'hasil', 'result', 'kasus'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Nilai $nilai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nilai $nilai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
}
