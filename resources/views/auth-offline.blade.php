@extends('layouts.master-without-nav')
@section('title')
@lang('translation.offline-page')
@endsection
@section('content')

<section class="auth-page-wrapper py-5 position-relative bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card mb-0">
                    <div class="card-body">
                        <div class="row g-0 align-items-center">
                            <div class="col-xxl-6 mx-auto">
                                <div class="card border-0 shadow-none mb-0">
                                    <div class="card-body p-sm-5 m-lg-4">
                                        <div class="mt-2 text-center">
                                            <div class="error-img text-center px-5">
                                                <img src="build/images/auth/offline.png" class="img-fluid" alt="">
                                            </div>
                                            <h5 class="mt-5 fw-semibold">We're Currently Offline</h5>
                                            <p class="text-muted mb-4">We can't show you this images because you aren't connected to the internet. When you’re back online refresh the page or hit the button below</p>
                                            <button class="btn btn-primary" onClick="window.location.href=window.location.href"><i class="ri-refresh-line align-bottom"></i> Refresh</button>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-5">
                                <div class="card auth-card bg-secondary h-100 border-0 shadow-none d-none d-sm-block mb-0">
                                    <div class="card-body py-5 d-flex justify-content-between flex-column h-100">
                                        <div class="text-center">
                                            <h5 class="text-white">Welcome to your Vixon.</h5>
                                            <p class="text-white opacity-75 fw-normal">It brings together your tasks, projects, timelines, files and more</p>
                                        </div>

                                        <div class="auth-effect-main my-5 position-relative rounded-circle d-flex align-items-center justify-content-center mx-auto">
                                            <div class="auth-user-list list-unstyled">
                                                <img src="build/images/auth/signin.png" alt="" class="img-fluid">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <p class="text-white opacity-75 mb-0 mt-3">
                                                &copy;
                                                <script>
                                                    document.write(new Date().getFullYear())

                                                </script> Vixon. Crafted with <i class="ti ti-heart-filled text-danger"></i> by Themesbrand
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>
    <!--end container-->
</section>

@endsection
