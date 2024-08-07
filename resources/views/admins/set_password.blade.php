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

            <form action="{{ route('admins.admin.set_new_password') }}" method="POST">
                @csrf
                @method('PATCH')
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
                                            <label for="current_password" class="form-label">Kata Laluan Sedia Ada</label>
                                            <input type="password" value="{{ old('current_password') }}"
                                                class="form-control" id="current_password"
                                                placeholder="Masukkan kata laluan sedia ada anda" name="current_password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="new_password" class="form-label">Kata Laluan Baru</label>
                                            <input type="password" value="{{ old('new_password') }}" class="form-control"
                                                id="new_password" placeholder="Masukkan kata laluan baru"
                                                name="new_password">
                                        </div>
                                        <div class="mb-3">
                                            <label for="password_confirmation" class="form-label">Masukkan Semula Kata
                                                Laluan Baru</label>
                                            <input type="password" value="{{ old('password_confirmation') }}"
                                                class="form-control" id="password_confirmation"
                                                placeholder="Taip semula kata laluan baru" name="password_confirmation">
                                        </div>


                                        <div class="mb-3">
                                            <button class="btn btn-danger" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-key" width="44" height="44"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" />
                                                    <path d="M15 9h.01" />
                                                </svg>
                                                Set Kata Laluan Baru
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer-admin')

@endsection
