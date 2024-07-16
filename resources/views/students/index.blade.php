@extends('layouts.app')
@section('title', 'eParcel Sys - Dashboard '.Auth::user()->name)
@section('content')
    <div id="Content">
        <div class="section" style="padding-top:100px;padding-bottom:100px;background-color:#f8f8f8">
            <div class="container">
                <div class="row" style="padding:30px">
                    <div class="col-lg-9 mb-3">
                        <h3>Hi, {{ Auth::user()->name }}</h3>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Semakan</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="card-title">Jumlah Barangan Tidak Dituntut</h3>
                                <h1 class="card-subtitle mb-2 text-warning">{{ $unretrieved }}</h1>
                                <a href="{{ route('students.inventory') }}" class="btn btn-warning">Lihat Inventori</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3 class="card-title">Jumlah Barangan Berdaftar</h3>
                                <h1 class="card-subtitle mb-2 text-success">{{ $item }}</h1>
                                <a href="{{ route('students.records') }}" class="btn btn-success">Lihat Rekod</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
