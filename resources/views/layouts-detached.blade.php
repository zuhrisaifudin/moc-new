@extends('layouts.layouts-detached')
@section('title')
    @lang('translation.detached')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Layouts
        @endslot
        @slot('title')
            Detached
        @endslot
    @endcomponent


@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
