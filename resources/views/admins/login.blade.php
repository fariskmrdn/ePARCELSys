@extends('layouts.admin-app')

@section('title', 'ePARCELSys - Log Masuk Admin')

@section('content')
    <div class="auth-main v1">
        <div class="auth-wrapper">
            <div class="auth-form">
                <div class="card my-5">
                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ URL::asset('images/eparcel.png') }}" alt="images" class="img-fluid mb-3">
                                <h4 class="f-w-500 mb-3">Log Masuk Admin</h4>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="floatingInput"
                                    placeholder="Masukkan nama pengguna" name="username">
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" id="floatingInput1"
                                    placeholder="Masukkan kata laluan" name="password">
                            </div>
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary">Log Masuk</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
