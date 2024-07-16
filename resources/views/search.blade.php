@extends('layouts.app')
@section('title', 'eParcel Sys - Carian ' . $search)
@section('content')
    <div id="Content">
        <div class="section" style="padding-top:100px;padding-bottom:100px;background-color:#f8f8f8">
            <div class="container">
                <div class="row" style="padding:30px">
                    <div class="col-12 text-center">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <hr class="no_line" style="margin:0 auto 50px">
                        @if (session('parcels'))
                            @php $no = 1; @endphp

                            <h2 class="text-center">Hasil Carian: {{ $search }}</h2>
                            @foreach (session('parcels') as $parcel)
                                <div class="card mb-2">
                                    <div class="card-body">
                                        <p>
                                            <strong>No Tracking :</strong>{{ $parcel->tracking }}
                                        </p>
                                        <p>
                                            <strong>Nama Penerima :</strong>{{ $parcel->receiver }}
                                        </p>
                                        <p>
                                            <strong>No Siri Ketibaan   :</strong>{{ $parcel->serial_no }}
                                        </p>
                                        <p>
                                            <strong>Tarikh dan Masa Ketibaan  
                                                :</strong>{{ \Carbon\Carbon::parse($parcel->created_at)->format('d/m/Y H:i A') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Harap Maaf. Tiada Carian Dijumpai. Sila Cuba Sekali Lagi.</p>
                        @endif
                        <a class="btn btn-primary" href="{{ route('index') }}">Kembali</a>
                    </div>

                </div>
            </div>
        </div>


    </div>
@endsection
