@extends('layouts.admin-app')

@section('title', 'ePARCELSys - Dashboard')

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
                                <h2 class="mb-0">ePARCELSys - Dashboard</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->

            <!-- [ Main Content ] start -->
            <div class="row">
                <!-- [ Row 1 ] start -->
                <div class="col-md-12 col-xxl-6">
                    <div class="card statistics-card-1">
                        <div class="card-body">
                            <img src="{{ URL::asset('admin/images/widget/img-status-2.svg') }}" alt="img"
                                class="img-fluid img-bg" />
                            <div class="d-flex align-items-center">
                                <div class="avtar bg-brand-color-1 text-white me-3">
                                    <i class="ph-duotone ph-package f-26"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0">Barangan Terkumpul (Tidak Dituntut)</p>
                                    <div class="d-flex align-items-end">
                                        <h2 class="mb-0 f-w-500">{{ $countItem }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-6 col-xxl-4">
                    <div class="card statistics-card-1">
                        <div class="card-body">
                            <img src="{{ URL::asset('admin/images/widget/img-status-1.svg') }}" alt="img" class="img-fluid img-bg" />
                            <div class="d-flex align-items-center">
                                <div class="avtar bg-brand-color-2 text-white me-3">
                                    <i class="ph-duotone ph-scales f-26"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0">Conversion Rate</p>
                                    <div class="d-flex align-items-end">
                                        <h2 class="mb-0 f-w-500">8.57<small class="text-muted">%</small></h2>
                                        <span class="badge bg-light-danger ms-2"><i class="ti ti-chevrons-down"></i>
                                            3.6%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-6 col-xxl-6">
                    <div class="card statistics-card-1">
                        <div class="card-body">
                            <img src="{{ URL::asset('admin/images/widget/img-status-3.svg') }}" alt="img"
                                class="img-fluid img-bg" />
                            <div class="d-flex align-items-center">
                                <div class="avtar bg-brand-color-3 text-white me-3">
                                    <i class="ph-duotone ph-users-four f-26"></i>
                                </div>
                                <div>
                                    <p class="text-muted mb-0">Akaun Pelajar Berdaftar</p>
                                    <div class="d-flex align-items-end">
                                        <h2 class="mb-0 f-w-500">{{ $countAccounts }}</h2>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Row 1 ] end -->
                <!-- [ Row 2 ] start -->
                <div class="col-md-6">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>5 Barang Yang Telah Didaftarkan</h5>
                        </div>
                        <div class="card-body py-3 px-0">
                            <div class="table-responsive affiliate-table">
                                <table class="table table-hover table-borderless mb-0">
                                    <tbody>
                                        @foreach ($showFiveInventory as $inv)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('admin/images/user/scanner.png') }}"
                                                            alt="" class="img-fluid wid-30 rounded-1" />
                                                        <h6 class="mb-0 ms-2">{{ $inv->tracking_no }}</h6>
                                                    </div>
                                                </td>
                                                <td> 21/07/24
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card table-card">
                        <div class="card-header">
                            <h5>5 Barang Yang Telah Dituntut</h5>
                        </div>
                        <div class="card-body py-3 px-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless mb-0">
                                    <tbody>
                                        @foreach ($showFiveClaimedItem as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ URL::asset('admin/images/user/parcel_check.png') }}"
                                                            alt="" class="img-fluid wid-30 rounded-1" />
                                                        <h6 class="mb-0 ms-2">{{ $item->tracking }}</h6>
                                                    </div>
                                                </td>
                                                <td>21/07/24
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Row 2 ] end -->
            </div>
            <!-- [ Main Content ] end -->
        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer-admin')
@endsection
