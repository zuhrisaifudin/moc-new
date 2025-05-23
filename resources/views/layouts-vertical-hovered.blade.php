@extends('layouts.layouts-vertical-hovered')
@section('title')
    @lang('translation.vertical-hovered')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Layouts
        @endslot
        @slot('title')
            Vertical Hovered
        @endslot
    @endcomponent

    
@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
