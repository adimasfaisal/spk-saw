@extends('layouts.app')

@section('title', 'Hitung')

@section('content')
    <div class="container p-5">
        <div class="my-4">
            <a href="{{route('dashboard')}}" class="btn btn-warning">Dashboard</a>
        </div>
        <h3>Tabel Nilai Hasil Normalisasi</h3>
        <hr>
        <table class="table shadow">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                    <th scope="col">Alternatif</th>
                    @foreach ($kriteria as $k)
                    <th scope="col">{{$k->namaKriteria}}<br><small>Bobot = {{$k->bobot}}</small></th>
                    @endforeach
              </tr>
            </thead>
            <tbody>
            @php
                $i = 1;    
            @endphp
            @foreach ($alternate as $a)
              <tr>
                <th scope="row">{{$i}}</th>
                <td><strong>{{$a->namaAlternatif}}</strong></td>
                @foreach ($data as $item)
                @if ($a->id == $item['idAlternatif'])
                    <td>{{$item['normalisasi']}}</td>
                @endif
                @endforeach
              </tr>
            @php
              $i++
            @endphp
            @endforeach
            </tbody>
          </table>

          <hr>
          <h3>Hasil Perhitungan</h3>
          <table class="table table-striped shadow">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Alternatif</th>
                    <th scope="col">Hasil</th>
              </tr>
            </thead>
            <tbody>
            @php
                $i = 1;    
            @endphp
            @foreach ($hasil as $a)
              <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$a['alternatif']}}</td>
                <td>{{$a['hasil']}}</td>
              </tr>
            @php
              $i++
            @endphp
            @endforeach
            </tbody>
          </table>

          <div class="mt-4">
              <hr>
            <p>Berdasarkan hasil perhitungan maka dapat disimpulkan bahwa alternatif yang paling cocok untuk <strong>{{$kasus->namaKasus}}</strong> adalah @foreach ($result['alt'] as $item)
              <ul>
                <li>
                    <strong>{{$item}}</strong>
                </li>  
                </ul>
            @endforeach  dengan nilai sebesar <strong>{{$result['value']}}</strong>.</p>
            </div>


    </div>
@stop

