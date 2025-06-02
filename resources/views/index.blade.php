@extends('layouts.master')
@section('title')
@lang('translation.dashboards')
@endsection
@section('content')

 <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Selamat Datang, {{ Auth::user()->name ?? '' }} </h4></br>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Role</a></li>
                        <li class="breadcrumb-item active">{{ Auth::user()->getRoleNames()->first() ?? '' }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

@endsection

@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/dashboard-analytics.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

