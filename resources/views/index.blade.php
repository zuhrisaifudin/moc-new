@extends('layouts.master')
@section('title')
@lang('translation.dashboards')
@endsection
@section('content')



@endsection

@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/dashboard-analytics.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

