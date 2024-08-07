@extends('layouts.admin-app')

@section('title', 'ePARCELSys - Set Kata Laluan')

@section('content')

    @include('layouts.sidebar-admin')
    @include('layouts.header-admin')



    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h2 class="mb-0">Set Kata Laluan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-xxl-12">
                    <div class="card statistics-card-1">
                        <div class="card-body">
                            <img src="{{ URL::asset('assets/images/widget/img-status-2.svg') }}" alt="img"
                                class="img-fluid img-bg" />
                            <div class="">
                                <div>
                                    <h5 class="text-muted mb-5">Set semula kata laluan di ruangan yang disediakan</h5>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Kata Laluan Sedia Ada</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan kata laluan sedia ada anda">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Kata Laluan Baru</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Masukkan kata laluan baru">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1" class="form-label">Masukkan Semula Kata Laluan Baru</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Taip semula kata laluan baru">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer-admin')

@endsection
