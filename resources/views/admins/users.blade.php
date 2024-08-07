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
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $bil = 1;
                                        @endphp
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $bil++ }}</td>
                                                <td>
                                                    <div class="d-inline-block align-middle">
                                                        {{-- <img src="../assets/images/user/avatar-1.jpg" alt="user image"
                                                            class="img-radius align-top m-r-15" style="width:40px;"> --}}
                                                        <div class="d-inline-block">
                                                            <h6 class="m-b-0">{{ $user->name }}</h6>
                                                            <p class="m-b-0 text-primary">{{ $user->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    @if ($user->status == '1')
                                                        <span class="badge bg-light-success">Aktif</span>
                                                    @else
                                                        <span class="badge bg-light-danger">Tidak Aktif</span>
                                                    @endif

                                                </td>
                                                <td class="text-center">
                                                    <div class="overlay-edit">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item m-0"><a
                                                                    href="{{ route('admins.admin.show_user', ['id' => encrypt_string($user->id)]) }}"
                                                                    class=" btn btn-secondary">
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                        class="icon icon-tabler icon-tabler-eye"
                                                                        width="44" height="44" viewBox="0 0 24 24"
                                                                        stroke-width="1.5" stroke="#ffffff" fill="none"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                        <path
                                                                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                                    </svg>
                                                                </a></li>

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
