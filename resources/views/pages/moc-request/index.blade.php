@extends('layouts.master')
@section('title')
    @lang('translation.dashboards')
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Permohonan Perubahan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Semua Permohonan</a></li>
                        <li class="breadcrumb-item active">Daftar Permohonan</li>
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
                            <p class="text-muted mb-0">Total Permohonan</p>
                        </div>
                    </div>
                    <h4 class="mb-0"><span class="counter-value" data-target="{{ $total_moc_requests }}">0</span></h4>
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
                            <p class="text-white text-opacity-75 mb-0">Total Disetujui</p>
                        </div>
                    </div>
                    <h4 class="text-white mb-0"><span class="counter-value" data-target="1">0</span> </h4>
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
                            <p class="text-muted mb-0">Total ditolak</p>
                        </div>
                    </div>
                    <h4 class="mb-0"><span class="counter-value" data-target="100">0</span> </h4>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-xs flex-shrink-0">
                            <div class="avatar-title bg-body-secondary text-danger border border-danger-subtle rounded-circle">
                                <i class="bi bi-file-earmark-plus"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-0">Total Temporary</p>
                        </div>
                    </div>
                    <h4 class="mb-0"><span class="counter-value" data-target="871">0</span></h4>
                </div>
            </div>
        </div>
        <div class="col-lg col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="avatar-xs flex-shrink-0">
                            <div class="avatar-title bg-body-secondary text-info border border-info-subtle rounded-circle">
                                <i class="bi bi-file-earmark-minus"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <p class="text-muted mb-0">Total Permanent</p>
                        </div>
                    </div>
                    <h4 class="mb-0"><span class="counter-value" data-target="871">0</span></h4>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->

    <div class="row" id="invoiceList">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light pb-2">
                    <h5 class="card-title mb-0">Semua Permohonan</h5>
                    <div class="row align-items-center g-2 mt-2 mb-2">
                        <div class="col-xl-2 col-md-3">
                            <div>
                                <input type="date" class="form-control" id="exampleInputdate" placeholder="Select date range" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true">
                            </div>

                        </div>
                        <div class="col-lg-auto">
                            <select class="form-control" data-choices data-choices-search-false name="choices-select-sortlist" id="choices-select-sortlist">
                                <option value="">Tahun</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                            </select>
                        </div>
                        <div class="col-lg-auto">
                            <select class="form-control"  id="filter-status-perubahan">
                                <option selected value="all">Semua Perubahan</option>
                                <option value="1">Temporary</option>
                                <option value="0">Permanent</option>
                            </select>
                        </div>
                        <div class="col-lg-auto">
                            <select class="form-control" data-choices data-choices-search-false name="choices-select-sortlist" id="choices-select-sortlist">
                                <option value="">Status MOC</option>
                                <option value="form-1">Form 1</option>
                                <option value="form-2">Form 2</option>
                                <option value="form-2">Form 3</option>
                                <option value="close">Close</option>
                            </select>
                        </div>

                        <div class="col-md-auto ms-auto">
                            <div class="hstack gap-2 mt-2 mt-md-0">
                                <a href="{{ route('central-moc-request-create-pages') }}" class="btn btn-secondary"><i class="bi bi-plus-circle align-baseline me-1"></i> Tambah Permohonan</a>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <div class="card-body">
                    <table id="datatable-moc-request" class="table nowrap table-hover align-middle" style="width:100%">
                        <thead class="table-light">
                        <tr>
                            <th>Aksi</th>
                            <th>Nomor MOC</th>
                            <th>Judul MOC</th>
                            <th>Status MOC</th>
                            <th>Jenis Perubahan</th>
                            <th>Tingkat Resiko</th>
                            <th>Diusulkan oleh</th>
                            <th>Wilayah</th>
                            <th>Area</th>
                            <th>Tanggal Permohonan</th>
                            <th>Tahapan Proses</th>
                            <th>Status Perubahan</th>
                            <th>Dokumen Referensi</th>
                            <th>Analysis Resiko</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    <x-modal id="add-tags-maps" title="Tags ID Asset" backdrop="true" size="modal-lg" >
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
        var $url_get_moc_request = "{{ route('central-get-moc-request-ajax') }}";
        var $url_delete_moc_request = "{{route('central-delete-moc-request-ajax','')}}";
        var $url_detail_maps_criteria= "{{route('central-detail-maps-moc-request-ajax','')}}";
        var $url_detail_aproval_line = "{{ route('central-get-user-approval-line-ajax') }}";
        var $url_detail_send_moc_request = "{{route('console-detail-send-moc-request-ajax','')}}";
         
    </script>
    <script src="{{ URL::asset('build/js/central/moc-request.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

