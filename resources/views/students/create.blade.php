@extends('layouts.app')
@section('title', 'eParcel Sys - Daftar Barang')
@section('content')
    <div id="Content">
        <div class="section" style="padding-top:100px;padding-bottom:100px;background-color:#f8f8f8">
            <div class="container">
                <div class="row" style="padding:30px">
                    <div class="col-12 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-center">Daftar No Tracking</h3>
                                <form action="{{ route('students.addParcel') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label mb-3">No Tracking (Masukkan satu
                                            nombor tracking sahaja!)</label>
                                        <input type="text"
                                            placeholder="Masukkan nombor tracking disini (Cth: SPXMY12E3R988DAA)"
                                            class="form-control text-center" style="border-color: black; color:black;"
                                            id="exampleInputEmail1" aria-describedby="emailHelp" name="tracking">
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Daftar Barang</button>
                                    </div>
                                </form>
                                {{-- @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session('result'))
                                    <div class="alert alert-{{ session('result') }}">
                                        <strong>{{ session('title') }}</strong> {{ session('message') }}
                                    </div>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
