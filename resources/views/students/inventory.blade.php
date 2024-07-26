@extends('layouts.app')
@section('title', 'eParcel Sys - Rekod Barangan Tidak Dituntut ' . Auth::user()->name)
@section('content')
    <div id="Content">
        <div class="section" style="padding-top:100px;padding-bottom:100px;background-color:#f8f8f8">
            <div class="container">
                <div class="row" style="padding:30px">
                    <div class="col-lg-9 mb-3">
                        <h3>Rekod Barangan Tidak Dituntut</h3>
                    </div>
                    <div class="col-lg-3">
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="col-lg-12">
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <td>Bil</td>
                                    <td>No Tracking</td>
                                    <td>Tarikh dan Masa Ketibaan</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $bil = 1;
                                @endphp
                                @foreach ($item as $rec)
                                    <tr>
                                        <td>{{ $bil++ }}</td>
                                        <td>{{ $rec->tracking }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rec->created_at)->format('d/m/Y h:i A') }}</td>
                                        <td>
                                            <strong class="text-danger">TIDAK DITUNTUT</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
