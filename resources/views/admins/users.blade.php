@extends('layouts.admin-app')

@section('title', 'ePARCELSys - Pengurusan Pengguna')

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
                                <h2 class="mb-0">Senarai Pengguna</h2>
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
                            <div class="table-responsive">
                                <table class="table display " id="users">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Status</th>
                                            <th>Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <div class="d-inline-block align-middle">
                                                        <img src="../assets/images/user/avatar-1.jpg" alt="user image"
                                                            class="img-radius align-top m-r-15" style="width:40px;">
                                                        <div class="d-inline-block">
                                                            <h6 class="m-b-0">{{ $user->name }}</h6>
                                                            <p class="m-b-0 text-primary">{{ $user->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($user->status == '1')
                                                        <span class="badge bg-light-success">Aktif</span>
                                                        @else
                                                        <span class="badge bg-light-danger">Tidak Aktif</span>

                                                    @endif

                                                </td>
                                                <td>
                                                    <div class="overlay-edit">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item m-0"><a href="#"
                                                                    class="avtar avtar-s btn btn-primary"><i
                                                                        class="ti ti-pencil f-18"></i></a></li>
                                                            <li class="list-inline-item m-0"><a href="#"
                                                                    class="avtar avtar-s btn bg-white btn-link-danger"><i
                                                                        class="ti ti-trash f-18"></i></a></li>
                                                        </ul>
                                                    </div>
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
        </div>

        <script>
            $(document).ready(function() {
                $('#users').DataTable();
            });
        </script>
        <!-- [ sample-page ] end -->
    </div>
@endsection
