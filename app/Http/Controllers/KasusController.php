<?php

namespace App\Http\Controllers;

use App\Alternatif;
use App\Kasus;
use App\Kriteria;
use App\Nilai;
use Illuminate\Http\Request;

class KasusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kasuses = Kasus::all();
        return view('dashboard', ['kasuses' => $kasuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah-kasus');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kasus = Kasus::create([
            'namaKasus'=>$request->kasus,
        ]);
        $id = $kasus->id;
        return redirect()->route('dashboard');
    }

    public function detail($id){
        $kasus = Kasus::where('id', $id)->first();
        $alternatif = Alternatif::where('idKasus', $kasus->id)->get();
        $kriteria = Kriteria::all();
        $nilai = Nilai::all();
        $max = count($nilai);
        $maxa = count($alternatif);
        $maxk = count($kriteria);
        $n = Nilai::where('idKasus', $id)->get();
        $maxn = count($n);
        $data = [];
        if (!empty($nilai)) {
            for ($i=0; $i < $maxa; $i++){ 
                for ($j=0; $j < $maxn; $j++) { 
                    $data[$i]['idKasus'] = $id;
                    $data[$i]['idAlternatif'] = $alternatif[$i]['id'];
                    $data[$i]['namaAlternatif'] = Alternatif::where('id', $alternatif[$i]['id'])->pluck('namaAlternatif')->first();
                    for ($k=0; $k < $maxk; $k++) { 
                        $idk = $kriteria[$k]['id'];
                        $data[$i]['kriteria'.$k] = Nilai::where(['idKasus' => $id, 'idAlternatif' => $data[$i]['idAlternatif'], 'idKriteria' => $kriteria[$k]['id']])->pluck('nilai')->first();
                    }
                }
            }
        } else {
            $data = [];
        }        
        return view('detail-kasus')->with(compact('kasus', 'alternatif', 'kriteria', 'nilai', 'data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function show(Kasus $kasus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function edit(Kasus $kasus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kasus $kasus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kasus  $kasus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kasus $kasus)
    {
        //
    }
}
