@extends('layouts.master')
@section('title')
    Master Tahapan
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Master Tahapan </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Semua Master Tahapan</a></li>
                        <li class="breadcrumb-item active">Daftar Master Tahapan</li>
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
                            <p class="text-muted mb-0">Total Tahapan</p>
                        </div>
                    </div>
                    <h4 class="mb-0"><span class="counter-value" data-target="{{ $totalStages}}">0</span></h4>
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
                    <h4 class="text-white mb-0"><span class="counter-value" data-target="{{ $totalActiveStages }}">0</span> </h4>
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
                    <h4 class="mb-0"><span class="counter-value" data-target="{{ $totalInactiveStages }}">0</span> </h4>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="row" id="invoiceList">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light pb-2">
                    <h5 class="card-title mb-0">Semua Master Tahapan</h5>
                    <div class="row align-items-center g-2 mt-2 mb-2">
                        
                        <div class="col-md-auto ms-auto">
                            <div class="hstack gap-2 mt-2 mt-md-0">
                                @can('create-stage')
                                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modal-add-stages">
                                    <i class="bi bi-plus-circle align-baseline me-1"></i> Tambah Tahapan
                                </button>
                                @endcan
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <div class="card-body">
                    <table id="datatable-stages" class="table nowrap table-hover align-middle" style="width:100%">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Tahapan</th>
                                <th>Tipe Form</th>
                                <th>Status Tahapan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    <x-modal id="add-stages" title="Tambah Tahapan" backdrop="true">
        @include('pages.master.stages.create')
    </x-console.modal>

    <x-modal id="edit-stages" title="Lihat Tahapan" backdrop="true">
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
        var $url_get_stages = "{{ route('central-get-stages-ajax') }}";
        var $url_detail_stages= "{{route('central-detail-stages-ajax','')}}";
        var $url_delete_stages = "{{route('central-delete-stages-ajax','')}}";

    </script>
    <script src="{{ URL::asset('build/js/central/stages/stages.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

