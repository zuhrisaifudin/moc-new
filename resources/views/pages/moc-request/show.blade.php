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

    <div class="row">

        <div class="col-12">
            @php
                $stages = ['submission', 'review', 'checklist1', 'checklist2', 'approval', 'closed'];
                $currentStage = $mocRequest->current_stage ?? 'submission';
                $found = false;
            @endphp

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ $mocRequest->moc_title ?? '' }}</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <p class="text-muted pb-2">{{ $mocRequest->moc_number ?? '' }}</p>
                    <div class="progress progress-step-arrow progress-info">
                        @foreach ($stages as $stage)
                            @php
                                $activeClass = !$found ? 'active' : '';
                                $pendingClass = ($stage == $currentStage) ? 'pending' : '';
                                if ($stage == $currentStage) {
                                    $found = true;
                                }
                            @endphp
                            <div class="progress-bar {{ $activeClass }} {{ $pendingClass }}" role="progressbar"
                                 style="width: {{ 100 / count($stages) }}%"
                                 aria-valuenow="{{ 100 / count($stages) }}"
                                 aria-valuemin="0"
                                 aria-valuemax="100">
                                {{ ucfirst($stage) }}
                            </div>
                        @endforeach
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->

        </div>

    </div>


@endsection

@section('script')
    <script>

    </script>
    <script src="{{ URL::asset('build/js/central/moc-request.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

