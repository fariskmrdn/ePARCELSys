@extends('layouts.admin-app')

@section('title', 'ePARCELSys - Dokumentasi')

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
                                <h2 class="mb-0">Dokumentasi</h2>
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
                                    <h5 class="text-muted mb-3">Pengenalan</h5>
                                    <p>
                                        eParcelSys merupakan sistem pengurusan barangan pelajar yang pertama kali
                                        dilaksanakan oleh Majlis Perwakilan Pelajar (Sesi 2021/2022), Kolej Vokasional Kuala
                                        Selangor. eParcelSys kemudian nya telah diberikan kepada Unit Hal Ehwal Pelajar
                                        (HEP) bagi membantu HEP menguruskan barangan pelajar.
                                    </p>
                                    <p>Objektif eParcelSys adalah :</p>
                                    <ol>
                                        <li>Merekod kemasukkan parcel/barangan pos secara sistematik.</li>
                                        <li>Membangunkan pangkalan data untuk melihat trend dan statistik semasa.</li>
                                        <li>Pengurusan inventori yang lebih teratur.</li>
                                        <li>Mengurangkan kes kecurian barang.</li>
                                    </ol>
                                    <h5 class="text-muted mb-3">Modul Rekod Simpanan Awal</h5>
                                    <p style="text-align: justify">
                                        Modul ini dibangunkan sebagai langkah pertama bagi proses dan prosedur penjejakan
                                        barang secara no. tracking. eParcelSys tidak disokong oleh mana-mana <em>API</em>
                                        penjejakan atas faktor keselamatan.
                                        Pelajar boleh mendaftar akaun dan mendaftar no. tracking di dalam sistem. Ketika
                                        barangan tiba di Pejabat Hal Ehwal Pelajar (HEP), pegawai bertugas hanya perlu
                                        mengimbas atau memasukkan no tracking ke dalam sistem (Di bahagian <em>side
                                            menu</em> sebelah kiri skrin, klik pada "Daftar Masuk Parcel")
                                    </p>
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
