@extends('layouts.app')
@section('title', 'eParcel Sys - Log Masuk Pelajar')
@section('content')
    <div id="Content">
        <div class="section" style="padding-top:100px;padding-bottom:100px;background-color:#f8f8f8">
            <div class="container">
                <div class="row" style="padding:30px">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title text-center">Log Masuk Pelajar</h3>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" placeholder="Masukkan emel disini" class="form-control" style="border-color: black; color:black;" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" placeholder="Masukkan katalaluan disini" class="form-control" style="border-color: black; color:black;" id="exampleInputPassword1">
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-text">Pengguna kali pertama? Daftar akaun di <a href="">sini</a></div>
                                        <button class="btn btn-primary">Log Masuk</button>
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
