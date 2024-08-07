@extends('layouts.admin-app')

@section('title', 'ePARCELSys - Rekod Inventori')

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
                                <h2 class="mb-0">Rekod Simpanan eParcel</h2>
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
                                    <h5 class="text-muted mb-3">Pangkalan Data eParcel</h5>
                                    <table class="table display" id="record">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No. Tracking</th>
                                                <th>Kurier</th>
                                                <th>No. Siri</th>
                                                <th>Status</th>
                                                <th class="text-center">Tindakan</th>
                                                <th class="d-none">Receiver Name</th> <!-- Hidden column -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $bil = 1;
                                            @endphp
                                            @foreach ($record as $key => $r)
                                                <tr>
                                                    <td>{{ $bil++ }}</td>
                                                    <td>{{ $r->tracking }}</td>
                                                    <td>{{ $r->courier == null ? 'MAKLUMAT TIDAK TERSEDIA' : $r->courier }}
                                                    </td>
                                                    <td>{{ $r->serial_no }}</td>
                                                    <td>
                                                        @if ($r->status == '1')
                                                            <strong class="text-info">BERDAFTAR</strong>
                                                        @else
                                                            <strong class="text-success">DITUNTUT</strong>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                                            data-bs-target="#viewModal{{ $key + 1 }} ">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-eye" width="44"
                                                                height="44" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="#2c3e50" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                                <path
                                                                    d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                                            </svg>
                                                        </button>
                                                    </td>
                                                    <td class="d-none">{{ $r->receiver }}</td> <!-- Hidden column value -->
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <script>
                                        $(document).ready(function() {
                                            $('#record').DataTable();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($record as $key => $m)
                <div class="modal fade" id="viewModal{{ $key + 1 }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-flex align-items-center">
                                <h4 class="modal-title" id="viewModal{{ $key + 1 }}Label">Maklumat barang
                                    {{ $m->tracking }}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mb-3">
                                            <p>
                                                <strong>Nama Penerima :</strong>
                                                {{ $m->receiver }}
                                            </p>
                                            <p>
                                                <strong>Emel Penerima :</strong>
                                                {{ $m->email == null ? 'Tidak Tersedia' : $m->email }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold mb-2"><strong>Pegawai Penerima</strong></label>
                                            <p>{{ $m->admin_name }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="font-weight-bold mb-2"><strong>Tarikh dan Masa Barang
                                                    Diterima</strong></label>
                                            <p>{{ \Carbon\Carbon::parse($m->created_at)->format('d/m/Y h:i A') }}</p>
                                        </div>
                                    </div>
                                    @if ($m->status == '2')
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="font-weight-bold mb-2"><strong>Tarikh dan Masa Barang
                                                        Dituntut</strong></label>
                                                <p>{{ \Carbon\Carbon::parse($m->updated_at)->format('d/m/Y h:i A') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            @if ($m->status == '1')
                                <div class="modal-footer">
                                    <form id="delete-form-{{ $m->id }}"
                                        action="{{ route('admins.admin.delete_item', [$m->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger"
                                            onclick="confirmDelete({{ $m->id }})">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash" width="44" height="44"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                            Padam Rekod
                                        </button>
                                    </form>
                                    <form id="success-form-{{ $m->tracking }}"
                                        action="{{ route('admins.admin.claimed', [$m->tracking]) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" class="btn btn-success"
                                            onclick="confirmSuccess('{{ $m->tracking }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-circle-check-filled" width="44"
                                                height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z"
                                                    stroke-width="0" fill="currentColor" />
                                            </svg>
                                            Daftar Keluar
                                        </button>
                                    </form>

                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach

            <script>
                function confirmSuccess(tracking) {
                    Swal.fire({
                        title: 'Adakah anda pasti?',
                        text: "Item ini akan disemak keluar dari sistem. Teruskan?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, daftar keluar!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('success-form-' + tracking).submit();
                        }
                    });
                }

                function confirmDelete(id) {
                    Swal.fire({
                        title: 'Adakah anda pasti?',
                        text: "Item ini akan DIHAPUSKAN dari rekod sistem. Adakah anda ingin meneruskan tindakan ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, padam rekod!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            </script>



        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer-admin')

@endsection
