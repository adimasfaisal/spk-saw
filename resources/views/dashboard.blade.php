@extends('layouts.app')

@section('title', 'Daftar Kasus')

@section('content')
    <div class="container p-5">
        <h1>Daftar Kasus</h1>
        <a href="{{route('kasus-baru')}}" class="btn btn-primary">Tambah Kasus</a>
        <hr>
        @foreach ($kasuses as $kasus)
        <a href="{{ url('kasus/' . $kasus->id) }}" style="text-decoration: none; color:black">
        <div class="container btn-block p-2 my-2 rounded" style="background-color: rgb(235, 212, 212)">
            <h4>{{$kasus->namaKasus}}</h4>
        </div>
        </a>
        @endforeach
    </div>
@stop