   <!-- [ Sidebar Menu ] start -->
   <nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{route('admins.admin.dashboard')}}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{URL::asset('images/eparcel.png')}}" alt="logo image" class="logo-lg w-50" />
                <span class="badge bg-brand-color-2 rounded-pill ms-2 theme-version">v5.0</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigasi</label>
                </li>
                <li class="pc-item pc-hasmenu">
                    <a href="{{route('admins.admin.dashboard')}}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-gauge"></i>
                        </span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                <li class="pc-item">
                    <a href="{{route('admins.admin.users')}}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-identification-card"></i>
                        </span>
                        <span class="pc-mtext">Pengurusan Pengguna</span>
                    </a>
                </li>
                <li class="pc-item">
                    <a href="{{route('admins.admin.addPage')}}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-database"></i>
                        </span>
                        <span class="pc-mtext">Daftar Masuk Parcel</span>
                    </a>
                </li>

                <li class="pc-item pc-hasmenu">
                    <a href="{{route('admins.admin.records')}}" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-books"></i>
                        </span>
                        <span class="pc-mtext">Rekod Barangan</span>
                    </a>
                </li>
                {{-- <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-magnifying-glass"></i>
                        </span>
                        <span class="pc-mtext">Carian</span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item"><a class="pc-link" href="../pages/search-page.html">Search Page</a></li>
                        <li class="pc-item"><a class="pc-link" href="../pages/contact-search.html">Contact Search</a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="pc-item">
                    <a href="../pages/settings.html" class="pc-link">
                        <span class="pc-micon">
                            <i class="ph-duotone ph-globe"></i>
                        </span>
                        <span class="pc-mtext">Site Settings</span>
                    </a>
                </li> --}}
            
               
            </ul>
            <div class="card nav-action-card bg-brand-color-4">
                <div class="card-body" style="background-image: url('../assets/images/layout/nav-card-bg.svg')">
                    <h5 class="text-dark">eParcel Sys dengan wajah yang baru!</h5>
                    <p class="text-dark text-opacity-75">Untuk maklumat lanjut mengenai versi terkini eParcel Sys, klik butang dibawah.</p>
                    <a href="{{route('admins.admin.documentation')}}" class="btn btn-primary" target="_blank">Akses Dokumentasi</a>
                </div>
            </div>
        </div>
        <div class="card pc-user-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="{{URL::asset('images/user.png')}}" alt="user-image"
                            class="user-avtar wid-45 rounded-circle" />
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="dropdown">
                            <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-offset="0,20">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 me-2">
                                        <h6 class="mb-0 text-break">{{ Auth::guard('admin')->user()->admin_name }}</h6>
                                        <small>Administrator</small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="btn btn-icon btn-link-secondary avtar">
                                            <i class="ph-duotone ph-windows-logo"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    {{-- <li>
                                        <a class="pc-user-links"> 
                                            <i class="ph-duotone ph-user"></i>
                                            <span>My Account</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="pc-user-links">
                                            <i class="ph-duotone ph-gear"></i>
                                            <span>Settings</span>
                                        </a>
                                    </li> --}}
                                    {{-- <li>
                                        <a class="pc-user-links">
                                            <i class="ph-duotone ph-lock-key"></i>
                                            <span>Lock Screen</span>
                                        </a>
                                    </li> --}}
                                    <li>
                                        <a href="{{route('admins.admin.logout')}}" class="pc-user-links">
                                            <i class="ph-duotone ph-power"></i>
                                            <span>Log Keluar</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end -->