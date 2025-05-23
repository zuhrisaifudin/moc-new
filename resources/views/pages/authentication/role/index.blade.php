@extends('layouts.master')
@section('title')
    Modul Role Aplikasi
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Manajemen Modul Role </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Semua Role Akses</a></li>
                        <li class="breadcrumb-item active">Daftar Role Akses</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="row row-cols-5 gx-3">
        <div class="col-lg col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-xs flex-shrink-0">
                            <div class="avatar-title bg-body-secondary text-primary border border-primary-subtle rounded-circle">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-0">Total Role</p>
                        </div>
                    </div>
                    <h4 class="mb-0"><span class="counter-value" data-target="{{ $totalRole }}">0</span></h4>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-6 col-12">
            <div class="card bg-primary">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-xs flex-shrink-0">
                            <div class="avatar-title bg-body-secondary text-primary border border-primary-subtle rounded-circle">
                                <i class="bi bi-file-earmark-check"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-white text-opacity-75 mb-0">Total Aktif</p>
                        </div>
                    </div>
                    <h4 class="text-white mb-0"><span class="counter-value" data-target="{{ $totalActiveRole }}">0</span> </h4>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-xs flex-shrink-0">
                            <div class="avatar-title bg-body-secondary text-warning border border-warning-subtle rounded-circle">
                                <i class="bi bi-clock-history"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-0">Total Tidak Aktif</p>
                        </div>
                    </div>
                    <h4 class="mb-0"><span class="counter-value" data-target="{{ $totalInactiveRole }}">0</span> </h4>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="row" id="invoiceList">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light pb-2">
                    <h5 class="card-title mb-0">Semua Modul Role Akses</h5>
                    <div class="row align-items-center g-2 mt-2 mb-2">
                        
                        <div class="col-md-auto ms-auto">
                            <div class="hstack gap-2 mt-2 mt-md-0">
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-add-role">
                                    <i class="bi bi-plus-circle align-baseline me-1"></i> Tambah Role Akses
                                </button>
                                <a href="" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modal-add-role">
                                    <i class="bi bi-plus-circle align-baseline me-1"></i> Restore Role 
                                </a>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <div class="card-body">
                    <table id="datatable-role" class="table nowrap table-hover align-middle" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Role</th>
                                <th>Display Role</th>
                                <th>Jumlah Permission</th>
                                <th>Guard Name</th>
                                <th>Status Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    <x-modal id="add-role" title="Tambah Role Akses" backdrop="true">
        @include('pages.authentication.role.create')
    </x-console.modal>

    <x-modal id="edit-role" title="Lihat Role Akses" backdrop="true">
        <div class="text-center">
            <span class="spinner-border flex-shrink-0" role="status">
                <span class="visually-hidden text-primary-emphasis">Loading...</span>
            </span>
        </div>
    </x-modal>

@endsection


@section('script')
    <script>
        var $datatable = null;
        var $url_get_role = "{{ route('central-get-role-ajax') }}";
        var $url_detail_role= "{{route('central-detail-role-ajax','')}}";
        var $url_delete_role = "{{route('central-delete-role-ajax','')}}";

    </script>
    <script src="{{ URL::asset('build/js/central/role/role.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

