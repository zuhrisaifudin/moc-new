<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="detached" data-sidebar="gradient" data-sidebar-size="sm" data-preloader="disable" data-theme="modern" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Pertamina Gas Negara  </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Pengelolaan Perubahan Pada Jaringan Dan Fasilitas Pipa Transmisi Dan Distribusi Gas" name="description" />
    <meta content="ZS19" name="author" />
      <meta content="{{ csrf_token() }}" name="x-token" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
    @include('layouts.head-css')
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

     @include('layouts.topbar')
     @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <!-- Start content -->
                <div class="container-fluid">
                    @yield('content')
                </div> <!-- content -->
            </div>
            @include('layouts.footer')
        </div>
        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    @include('layouts.customizer')
    <!-- END Right Sidebar -->

    @include('layouts.vendor-scripts')
</body>

</html>
