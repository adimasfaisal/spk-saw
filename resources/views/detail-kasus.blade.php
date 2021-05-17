@extends('layouts.app')

@section('title', 'Detail Kasus')

@section('content')
    <div class="container p-5">
        <h1>Detail Kasus</h1>
        <hr>
        <p class="my-2">Berikut ini detail untuk Kasus <strong>{{$kasus->namaKasus}}</strong></p>

        <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Kriteria</th>
                <th scope="col">Bobot</th>
                <th scope="col">Jenis</th>
              </tr>
            </thead>
            <tbody>
            @php
                $i = 1;    
            @endphp
            @foreach ($kriteria as $k)
              <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$k->namaKriteria}}</td>
                <td>{{$k->bobot}}</td>
                <td>
                    @if ($k->idJenis == 1)
                        Benefit
                    @else
                        Cost    
                    @endif
                </td>
              </tr>
            @php
                $i++
            @endphp
            @endforeach
            </tbody>
          </table>
        

        {{-- <a href="{{route('tambah-alternatif', $kasus->id)}}" class="btn btn-primary">Tambah Alternatif</a> --}}
        
        <hr>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-4 btn-block" data-toggle="modal" data-target="#alternatifModal">
            Tambah Alternatif
        </button>
        <form action="{{route('tambah-alternatif', $kasus->id)}}" method="get">
        @csrf
        <input type="hidden" name="idKasus" value="{{$kasus->id}}">
        <!-- Modal -->
        <div class="modal fade" id="alternatifModal" tabindex="-1" role="dialog" aria-labelledby="alternatifModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="alternatifModalLabel">Buat Alternatif Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <p>Nama Alternatif</p>
                        </div>
                        <div class="col-8">
                            <input type="text" name="namaAlternatif" id="namaAlternatif" placeholder="Masukkan Nama Alternatif" class="form-control">
                        </div>
                    </div>
                    @foreach ($kriteria as $krt)
                    <div class="row mt-2">
                        <div class="col-4">
                            <p>Nilai {{$krt->namaKriteria}}</p>
                        </div>
                        <div class="col-8">
                            <input type="text" name="nilai[]" id="nilai" placeholder="Masukkan Nilai Untuk Kriteria {{$krt->namaKriteria}}" class="form-control">
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </div>
        </div>
        </form>

        @if (count($alternatif) == 0)
            <b>Anda Belum Menambahkan Alternatif</b>
        @else
            <b>Berikut ini daftar alternatif untuk kasus {{$kasus->namaKasus}}</b>
            <br>

            <table class="table table-striped">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Alternatif</th>
                    @foreach ($kriteria as $k)
                    <th scope="col">Nilai {{$k->namaKriteria}}</th>
                    @endforeach
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $i = 1;    
                @endphp
                @foreach ($data as $d)
                  <tr>
                    <th scope="row">{{$i}}</th>
                    <td>{{$d['namaAlternatif']}}</td>
                    <td>{{$d['kriteria0']}}</td>
                    <td>{{$d['kriteria1']}}</td>
                    <td>{{$d['kriteria2']}}</td>
                    <td>{{$d['kriteria3']}}</td>
                    <td><button class="btn btn-warning" data-toggle="modal" data-target="#alternatifModal{{$d['idAlternatif']}}">Ubah Nilai</button>
                        <form action="{{route('tambah-nilai', $kasus->id)}}" method="get">
                            @csrf
                            <input type="hidden" name="idKasus" value="{{$kasus->id}}">
                            <input type="hidden" name="idAlternatif" value="{{$d['idAlternatif']}}">
                            <!-- Modal -->
                            <div class="modal fade" id="alternatifModal{{$d['idAlternatif']}}" tabindex="-1" role="dialog" aria-labelledby="alternatifModal{{$d['idAlternatif']}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="alternatifModal{{$d['idAlternatif']}}Label">Ubah Nilai Alternatif</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        @foreach ($kriteria as $krit)
                                        
                                        <div class="row mt-2">
                                            <div class="col-4">
                                                <p>{{$krit->namaKriteria}}</p>
                                            </div>
                                            <div class="col-8">
                                                <input type="hidden" name="idKriteria[]" value="{{$krit->id}}">
                                                <input type="text" name="nilai[]" id="nilai" placeholder="Masukkan Nilai Untuk Kriteria {{$krit->namaKriteria}}" class="form-control">
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </form>
                    </td>
                    
                  </tr>
                @php
                    $i++
                @endphp
                @endforeach
                </tbody>
              </table>
        @endif
        <hr class="mb-3">
        <b>Untuk melakukan perhitungan silahkan klik tombol berikut</b>
        <form action="{{route('hitung', $kasus->id)}}" method="get">
            @csrf
            <input type="hidden" name="idKasus" value="{{$kasus->id}}">
            <button type="submit" class="btn btn-block btn-success mt-2">Hitung</button>
        </form>
    </div>
@stop