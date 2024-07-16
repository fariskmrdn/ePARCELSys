@extends('layouts.app')
@section('title', 'eParcel Sys - Daftar Akaun')
@section('content')
    <div id="Content">
        <div class="section" style="padding-top:100px;padding-bottom:100px;background-color:#f8f8f8">
            <div class="container">
                <div class="row" style="padding:30px">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-center">Pendaftaran Akaun</h3>
                                <form action="{{ route('parcel.registerAccount') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Nama Penuh</label>
                                        <input type="text" placeholder="Masukkan nama penuh" class="form-control"
                                            style="border-color: black; color:black;" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Alamat Emel</label>
                                        <input type="email" placeholder="Masukkan emel disini" class="form-control"
                                            style="border-color: black; color:black;" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Kata Laluan</label>
                                        <input type="password" placeholder="Masukkan katala luan disini"
                                            class="form-control" style="border-color: black; color:black;"
                                            id="exampleInputPassword1" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Masuk Kata Laluan
                                            Semula</label>
                                        <input type="password" placeholder="Masukkan semula kata laluan disini"
                                            class="form-control" style="border-color: black; color:black;"
                                            id="exampleInputPassword1" name="password_confirmation">
                                    </div>
                                    <div class="mb-3">
                                        <a href="{{ route('parcel.login') }}" class="btn btn-secondary">Kembali ke log
                                            masuk</a>
                                        <button type="submit" class="btn btn-primary">Daftar Akaun</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
