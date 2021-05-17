@extends('layouts.app')

@section('title', 'Tambah Kasus')

@section('content')
    <div class="container p-5">
        <h1>Tambah Kasus Baru</h1>
        <hr>
        <form action="{{route('tambah-kasus')}}" method="get">
        @csrf
        <input type="hidden">
        <div class="py-3">
            <div class="row">
                <div class="col-3">
                    <h5>Nama Kasus</h5>
                </div>
                <div class="col-9">
                    <input type="text" name="kasus" id="kasus" placeholder="Masukkan Nama Kasus Baru" class="form-control">
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <button type="submit" class="btn btn-block btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </div>
        </form>
    </div>
@stop