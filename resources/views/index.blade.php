@extends('layouts.app')
@section('title', 'KVKS eParcel Sys - Jejak Barang Anda')
@section('content')
    <div id="Content">
        <div class="section" style="padding-top:100px;padding-bottom:100px;background-color:#f8f8f8">
            <div class="container">
                <div class="row" style="padding:30px">
                    <div class="col-12 text-center">
                        <h2>Jejak & Kesan Barangan Anda Disini</h2>
                        <p>
                            Carian yang lebih mudah dengan sistem eParcel. Mudah, cepat dan pantas!
                        </p>
                    </div>
                    <div class="col-12 text-center">
                        <hr class="no_line" style="margin:0 auto 50px">
                        <form action="{{ route('findParcel') }}" method="POST">
                            @csrf
                            <input type="text" name="track" class="form-control text-center mb-3"
                                style="background-color:white; color:black;"
                                placeholder="Masukkan No. Tracking atau Nama Anda disini">
                            <button class="btn btn-primary">Cari Sekarang</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="section mcb-section bg-cover"
            style="padding-top:100px;padding-bottom:140px;background-image:url({{ asset('images/biz-home-bg.png') }});background-repeat:no-repeat;background-position:center bottom">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <h6>Kenapa Guna eParcel Sys?</h6>
                        <h1>Cari dan Jejak Keberadaan Barang
                            <br>
                            Belian Anda
                        </h1>
                        <hr class="no_line" style="margin:0 auto 50px">
                    </div>
                    <div class="col-md-6">
                        <div class="image_frame image_item no_link scale-with-grid aligncenter no_border">
                            <div class="image_wrapper"><img class="scale-with-grid"
                                    src="{{ asset('images/biz3-about-img-1.jpg') }}" alt="biz3-about-img-1" width="500"
                                    height="780"> </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding:50px 0%">
                        <div class="row">
                            <div class="col-md-10">
                                <h3>eParcel Sys
                                    <br>
                                    Sistem Pengurusan dan Pengendalian Barang Belian Warga KVKS
                                </h3>
                                <hr class="no_line" style="margin: 0 auto 30px auto">
                                <ul class="list_check">
                                    <li>
                                        <strong>Pantas dan Cepat</strong>
                                        <p>Periksa Sama Ada Bungkusan Anda Telah Berada atau Diterima Di Pejabat Hal
                                            Ehwal Pelajar</p>
                                    </li>
                                    <li>
                                        <strong>Mudah dan Senang
                                        </strong>
                                        <p>Hanya Masukkan No. Tracking atau Nama Anda Untuk Carian Pantas</p>
                                    </li>
                                    <li>
                                        <strong>Tak Payah "Selongkar" Dah

                                        </strong>
                                        <p>Periksa No. Barangan Anda, Dan Tuntut Di Kaunter

                                        </p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
