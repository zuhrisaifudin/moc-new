<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-sidebar="gradient" data-sidebar-size="sm-hover" data-preloader="disable" card-layout="" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Pertamina Gas Negara  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Pengelolaan Perubahan Pada Jaringan Dan Fasilitas Pipa Transmisi Dan Distribusi Gas" name="description" />
    <meta content="ZS19" name="author" />
    <meta content="{{ csrf_token() }}" name="x-token" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico') }}">

    @include('layouts.head-css')
</head>

@yield('body')

@yield('content')

@include('layouts.vendor-scripts')
</body>

</html>
