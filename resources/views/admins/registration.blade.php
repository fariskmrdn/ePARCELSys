@extends('layouts.admin-app')

@section('title', 'ePARCELSys - Daftar Masuk Barang {{ $trackingNo }}')

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
                                <h2 class="mb-0">Daftar Masuk Barang {{ $trackingNo }}
                                </h2>
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
                                    <h5 class="text-muted mb-3">Borang daftar masuk barang.</h5>
                                    <p class="muted">* Sila isi borang ini dengan lengkap</p>
                                    <form action="{{ route('admins.admin.register') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-4">
                                                <label for="trackingNo" class="form-label">No. Tracking</label>
                                                <input type="text" name="tracking_no" value="{{ $trackingNo }}"
                                                    readonly class="form-control w-100 mb-4" id="trackingNo"
                                                    placeholder="Masukkan/Imbas No Tracking">
                                            </div>
                                            <div class="mb-3 col-4">
                                                <label for="trackingNo" class="form-label">Kurier</label>
                                                <select class="form-control" name="" id="">
                                                    <option value="">Maklumat Tidak Tersedia</option>
                                                    <option value="">Shopee Express</option>
                                                    <option value="">J&T Malaysia</option>
                                                    <option value="">Pos Malaysia/PosLaju</option>
                                                    <option value="">Ninja Van</option>
                                                    <option value="">DHL Express</option>
                                                    <option value="">FedEx</option>
                                                    <option value="">Skynet</option>
                                                    <option value="">Aramex</option>
                                                    <option value="">ABX Express</option>
                                                    <option value="">City-Link Express</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-4">
                                                <label for="trackingNo" class="form-label">Nama Penerima</label>
                                                <input type="text" name="receiver" value=""
                                                    class="form-control w-100 mb-4" id="trackingNo"
                                                    placeholder="Masukkan nama penerima">
                                            </div>
                                        </div>


                                        <script>
                                            $(document).ready(function() {
                                                $('#trackingNo').focus();
                                            });
                                        </script>
                                        <a href="{{ route('admins.admin.addPage') }}" class="btn btn-secondary">Kembali</a>
                                        <button class="btn btn-success" type="submit">Daftar Masuk</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->


        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer-admin')

@endsection
