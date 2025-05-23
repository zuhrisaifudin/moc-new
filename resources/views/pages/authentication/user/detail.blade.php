@extends('layouts.master')
@section('title')
    Modul User Aplikasi
@endsection
@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Manajemen User </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Semua User Akses</a></li>
                        <li class="breadcrumb-item active">Daftar User Akses</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">User {{ $user->name ?? '_' }}</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama User</label>
                        <input class="form-control" value="{{ $user->name  ?? '_'  }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="dislay_name" class="form-label">Email</label>
                        <input class="form-control" value="{{ $user->email  }}" disabled>
                    </div>
                    
                </div>
                <div class="card-footer">
                    <a href="{{ route('central-user-page') }}" class="link-success float-end">Back To<i class="ri-arrow-right-s-line align-middle ms-1 lh-1"></i></a>
                    <p class="text-muted mb-0">{{ $user->created_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-light pb-2">
                    <h5 class="card-title mb-0">User {{ $user->name ?? '_' }}</h5>
                </div>
                <!-- Accordion Flush Example -->
                <div class="card-body">
                    <div class="accordion lefticon-accordion custom-accordionwithicon accordion-border-box" id="accordionlefticon">
                        @php
                            $accordion = 0;
                        @endphp
                        @foreach ($module as $item)
                            <div class="accordion-item mt-2">
                                <h2 class="accordion-header" id="accordionlefticon{{$item->id}}">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_lefticon{{$item->id}}" aria-expanded="{{ ($accordion == 0) ? 'true' : 'false'}}" aria-controls="accor_lefticon{{$item->id}}">{{ $item->name }}</button>
                                </h2>
                                <div id="accor_lefticon{{$item->id}}" class="accordion-collapse collapse" aria-labelledby="accordionlefticon{{$item->id}}" data-bs-parent="#accordionlefticon">
                                    <div class="accordion-body">
                                        @foreach ($item->permissions as $row)
                                            <div class="list-group mb-1">
                                               <label class="list-group-item">
                                                    <input class="form-check-input me-1" type="checkbox" id="inlineCheckbox{{$row->id}}" value="option{{$row->id}}" data-permission="{{ $row->name }}"
                                                        @if ($AllRoles->pluck('name')->contains($row->name)) checked @endif>
                                                    {{ $row->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        $(function(){
            
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':$('meta[name="x-token"]').attr("content")
            }
            });
                $(document).on('click', 'input[type=checkbox]', function(e){
                console.log($(this).data('permission'))
                if($(this).is(':checked')){
                    console.log("Checked")
                    $.ajax({
                        type:'POST',
                        url: '{{ route('central-permission-user-attach', $user->id) }}',
                        data: {
                            permission: $(this).data('permission')
                        },
                        success: function(data){
                            Swal.fire({
                                html: '<div class="mt-3"><img src="{{ URL::asset('build/images/success-img.png') }}" alt=""  height="150"></img><div class="mt-4 pt-2 fs-base"><h4>Well done !</h4><p class="text-muted mx-4 mb-0">Aww yeah, Hak Akses berhasil diberikan</p></div></div>',
                                showCancelButton: !0,
                                showConfirmButton: !1,
                                customClass: {
                                    cancelButton: "btn btn-primary w-xs mb-1"
                                },
                                cancelButtonText: "Back",
                                buttonsStyling: !1,
                                showCloseButton: !0,
                                timer: 1500
                            });
                        }
                    })
                } else {
                    $.ajax({
                        type:'POST',
                        url: '{{ route('central-permission-user-detach', $user->id) }}',
                        data: {
                            permission: $(this).data('permission')
                        },
                        success: function(data){
                            Swal.fire({
                                html: '<div class="mt-3"><i class="bi bi-exclamation-triangle display-5 text-warning"></i><div class="mt-4 pt-2 fs-base"><h4>Oops...! Hak Akses telah dicabut</h4><p class="text-muted mx-4 mb-0"></p></div></div>',
                                showCancelButton: !0,
                                showConfirmButton: !1,
                                customClass: {
                                    cancelButton: "btn btn-primary w-xs mb-1"
                                },
                                cancelButtonText: "Dismiss",
                                buttonsStyling: !1,
                                showCloseButton: !0,
                                timer: 1500
                            });
                        }
                    })
                }
            });
        })
    </script>
    <script src="{{ URL::asset('build/js/central/role/role.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

