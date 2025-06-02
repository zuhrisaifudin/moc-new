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
                $stages = ['1', '2', '3', '4', '5', '6' ,'7'];
                $stageLabels = [
                    '1' => 'Pending',
                    '2' => 'Submission',
                    '3' => 'Review',
                    '4' => 'Checklist 1',
                    '5' => 'Checklist 2',
                    '6' => 'Approval',
                    '7' => 'Closed'
                ];
                $currentStage = $mocRequest->current_stage ?? '1';
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
                                {{ $stageLabels[$stage] ?? $stage }}
                            </div>
                        @endforeach
                    </div>
                </div><!-- end card-body -->
            </div><!-- end card -->

        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex position-relative">
                        @php
                           $selected = $mocRequest->type_of_change ?? [];
                        @endphp
                        <table>
                            <tr>
                                <th>Judul</th>
                                <td>: {{ $mocRequest->moc_title ?? '' }}</td>
                                </tr>
                                <tr>
                                <th>Nomor</th>
                                <td>: {{ $mocRequest->moc_number ?? '' }}5</td>
                                </tr>
                                <tr>
                                    <th>Jenis Perubahan</th>
                                    <td>: 
                                        <label><input class="form-check-input me-1" type="checkbox" {{ in_array("1", $selected) ? 'checked' : '' }}> Instalasi</label>
                                        <label><input class="form-check-input me-1"  type="checkbox" {{ in_array("2", $selected) ? 'checked' : '' }}> Proses</label>
                                        <label><input class="form-check-input me-1"  type="checkbox" {{ in_array("3", $selected) ? 'checked' : '' }}> Peraturan dan Persyaratan</label>
                                        <label><input class="form-check-input me-1"  type="checkbox" {{ in_array("4", $selected) ? 'checked' : '' }}> Lainnya</label>
                                    </td>
                                </tr>
                                <tr>
                                    @php
                                        $typeLabels = [
                                            1 => ['text' => 'Low', 'class' => 'bg-low text-white'],
                                            2 => ['text' => 'Low to Moderate', 'class' => 'bg-low-moderate text-white'],
                                            3 => ['text' => 'Moderate', 'class' => 'bg-moderate text-dark'],
                                            4 => ['text' => 'Moderate to High', 'class' => 'bg-moderate-high text-white'],
                                            5 => ['text' => 'High', 'class' => 'bg-high text-white'],
                                        ];

                                        $tipe = intval($mocRequest->risk_level ?? 0);
                                    @endphp
                                    <th>Tingkat Risiko</th>
                                    <td>: 
                                        @if (array_key_exists($tipe, $typeLabels))
                                            <span class="badge {{ $typeLabels[$tipe]['class'] }}">
                                                {{ $typeLabels[$tipe]['text'] }}
                                            </span>
                                        @else
                                            <span class="badge bg-light text-dark">Tidak diketahui</span>
                                        @endif
                                    </td>
                                </tr>
                                 <tr>
                                    <th>Dokumen Risiko</th>
                                    <td>: 
                                        @if(!empty($mocRequest->risk_level_document))
                                            <a href="{{ asset('storage/' . $mocRequest->risk_level_document) }}" target="_blank">Lihat Dokumen</a>
                                        @else
                                            <span>Belum ada dokumen</span>
                                        @endif
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h5><strong>Alasan Permintaan Perubahan:</strong></h5>
                    <div class="card-text mb-0 p-3">
                        {!! $mocRequest->change_reason ?? '' !!}
                    </div>
                    <h5 class="mt-3"><strong>Bagian Yang diubah :</strong></h5>
                    <div class="card-text mb-0 p-3">
                        {!! $mocRequest->changed_parts ?? '' !!}
                    </div>
                    <h5 class="mt-3"><strong>Diubah Menjadi :</strong></h5>
                    <div class="card-text mb-0 p-3">
                        {!! $mocRequest->changed_to ?? '' !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                <div class="card">
                <div class="card-body">
                    <div class="d-flex position-relative">
                        <div class="rounded-3 text-center" style="min-width: 300px; flex: 1;">
                            @php
                                $approval = $mocRequest->approvalWorkflows->where('role', 1)->first();
                            @endphp
                            <div class="text-start">
                                <strong>Fungsi Pengusul</strong><br>
                                Tanggal: {{ $approval?->approved_at ? \Carbon\Carbon::parse($approval->approved_at)->format('d-m-Y') : '-' }}
                            </div>
                            @if ($approval?->status == 'approved')
                                <img src="{{ URL::asset('build/images/approved.png') }}" alt="Approved" style="height: 40px; margin: 10px auto;">
                            @endif
                            @if ($approval?->status == 'rejected')
                                <img src="{{ URL::asset('build/images/reject.png') }}" alt="Reject" style="height: 40px; margin: 10px auto;">
                            @endif
                            <div class="mt-2">
                    
                                (<strong>{{ $approval?->user?->name ?? '-' }}</strong>)<br>
                                {{ $approval?->user?->position ?? '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex position-relative">
                            <div class="rounded-3 text-center" style="min-width: 300px; flex: 1;">
                            @php
                                $approval = $mocRequest->approvalWorkflows->where('role', 2)->first();
                            @endphp
                            <div class="text-start">
                                <strong>Fungsi Pemeriksa</strong><br>
                                Tanggal: {{ $approval?->approved_at ? \Carbon\Carbon::parse($approval->approved_at)->format('d-m-Y') : '-' }}
                            </div>
                            @if ($approval?->status == 'approved')
                                <img src="{{ URL::asset('build/images/approved.png') }}" alt="Approved" style="height: 40px; margin: 10px auto;">
                            @endif
                            @if ($approval?->status == 'rejected')
                                <img src="{{ URL::asset('build/images/reject.png') }}" alt="Reject" style="height: 40px; margin: 10px auto;">
                            @endif
                            <div class="mt-2">
                                (<strong>{{ $approval?->user?->name ?? '-' }}</strong>)<br>
                                {{ $approval?->user?->position ?? '-' }}
                            </div>
                        </div>
                    
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script>

    </script>
    <script src="{{ URL::asset('build/js/central/moc-request.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

