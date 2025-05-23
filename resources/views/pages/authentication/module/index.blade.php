@extends('layouts.master')
@section('title')
    Modul Aplikasi
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Manajemen Modul Aplikasi </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Semua Modul</a></li>
                        <li class="breadcrumb-item active">Daftar Modul</li>
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
                            <p class="text-muted mb-0">Total Modul</p>
                        </div>
                    </div>
                    <h4 class="mb-0"><span class="counter-value" data-target="{{ $total_module }}">0</span></h4>
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
                    <h4 class="text-white mb-0"><span class="counter-value" data-target="{{ $total_active_module }}">0</span> </h4>
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
                    <h4 class="mb-0"><span class="counter-value" data-target="{{ $total_inactive_module }}">0</span> </h4>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="row" id="invoiceList">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light pb-2">
                    <h5 class="card-title mb-0">Semua Modul Aplikasi</h5>
                </div>
                <div class="card-body">
                    <table id="datatable-module" class="table nowrap table-hover align-middle" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Modul</th>
                                <th>Deskripsi Modul</th>
                                <th>Total Permission</th>
                                <th>Status Core</th>
                                <th>Status Modul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    <x-modal id="edit-module" title="Lihat Modul Aplikasi" backdrop="true" size=modal-lg>
        <div class="text-center">
            <span class="spinner-border flex-shrink-0" role="status">
                <span class="visually-hidden text-primary-emphasis">Loading...</span>
            </span>
        </div>
    </x-modal>

    <x-modal id="show-module" title="Lihat Modul Aplikasi" backdrop="true" size=modal-lg>
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
        var $url_get_module= "{{ route('central-get-module-ajax') }}";
        var $url_detail_module= "{{route('central-detail-module-ajax','')}}";
        var $url_show_module= "{{route('central-show-module-ajax','')}}";

        
    </script>
    <script src="{{ URL::asset('build/js/central/module/module.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

