@extends('layouts.admin-app')

@section('title', 'ePARCELSys - ' . $user->name)

@section('content')

    @include('layouts.sidebar-admin')
    @include('layouts.header-admin')
    <div class="pc-container">
        <div class="pc-content">
            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <a href="{{ route('admins.admin.users') }}" class="btn btn-secondary mb-4">Kembali</a>
                                <h2 class="mb-0">Profil {{ $user->name }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <!-- [ sample-page ] start -->
                <div class="col-sm-12 col-md-12 col-xxl-12">
                    <div class="card statistics-card-1 ">
                        <div class="card-body">
                            <img src="{{ URL::asset('assets/images/widget/img-status-2.svg') }}" alt="img"
                                class="img-fluid img-bg" />

                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <h3>Maklumat Pengguna</h3>
                                </div>
                                <div class="col-lg-3">
                                    <h5>Email</h5>
                                    <p>{{ $user->email }}</p>
                                </div>
                                <div class="col-lg-3">
                                    <h5>Tarikh/Masa Log Masuk Terakhir</h5>
                                    <p>{{ date('d/m/Y h:i A', strtotime($user->last_login_at)) }}</p>
                                </div>
                                <div class="col-lg-3">
                                    <h5>Tarikh/Masa Akaun Dicipta</h5>
                                    <p>{{ date('d/m/Y h:i A', strtotime($user->created_at)) }}</p>
                                </div>
                                <div class="col-lg-3">
                                    <h5>Status Akaun</h5>
                                    <p>
                                        @if ($user->status == '1')
                                            <span class="badge bg-light-success">Aktif</span>
                                        @else
                                            <span class="badge bg-light-danger">Tidak Aktif</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <hr>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <h5>Rekod Barang</h5>
                                    <p>* Rekod hanya memaparkan senarai barang yang di daftarkan melalui akaun ini.</p>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="table-responsive">
                                        <table class="table display " id="users">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Bil</th>
                                                    <th>No. Tracking</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Tarikh dan Masa</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $bil = 1;
                                                @endphp
                                                @foreach ($findItem as $item)
                                                    <tr>
                                                        <td class="text-center">{{ $bil++ }}</td>
                                                        <td>{{ $item->tracking }}</td>
                                                        <td class="text-center">
                                                            @if ($item->status == '2')
                                                                <span class="badge bg-light-success">Dituntut</span>
                                                            @else
                                                                <span class="badge bg-light-danger">Tidak Dituntut</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            {{ date('d/m/Y h:i A', strtotime($item->created_at)) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <form
                                        action="{{ route('admins.admin.change_status', ['id' => encrypt_string($user->id)]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @if ($user->status == '1')
                                            <button type="submit" class="btn btn-danger">Nyahaktif Akaun</button>
                                        @else
                                            <button type="submit" class="btn btn-success">Aktifkan Akaun</button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#users').DataTable();
            });
        </script>
        <!-- [ sample-page ] end -->
    </div>
@endsection
