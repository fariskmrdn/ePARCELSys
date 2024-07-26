@extends('layouts.app')
@section('title', 'eParcel Sys - Semak Barang ' . Auth::user()->name)
@section('content')
    <div id="Content">
        <div class="section" style="padding-top:100px;padding-bottom:100px;background-color:#f8f8f8">
            <div class="container">
                <div class="row" style="padding:30px">
                    <div class="col-lg-8 mb-3">
                        <h3>Rekod No Tracking</h3>
                    </div>
                    <div class="col-lg-4">
                        <a href="{{ route('students.create') }}" class="btn btn-primary">Tambah Semakan</a>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="col-lg-12">
                        <table class="table display" id="example">
                            <thead>
                                <tr>
                                    <td>Bil</td>
                                    <td>No Tracking</td>
                                    <td>Tarikh Daftar</td>
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
                                        <td>{{ $rec->tracking_no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rec->created_at)->format('d/m/Y h:i A') }}</td>
                                        <td>
                                            @if ($rec->status == '0')
                                                <strong class="text-info">Rekod Disimpan</strong>
                                            @elseif ($rec->status == '1')
                                                <strong class="text-success">Tiba</strong>
                                            @elseif ($rec->status == '2')
                                                <strong class="text-secondary">Dituntut</strong>
                                            @endif
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
