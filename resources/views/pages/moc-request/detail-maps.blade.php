@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('build/libs/@simonwep/pickr/themes/classic.min.css') }}" >
<link rel="stylesheet" href="{{ URL::asset('build/libs/@simonwep/pickr/themes/monolith.min.css') }}" > 
<link rel="stylesheet" href="{{ URL::asset('build/libs/@simonwep/pickr/themes/nano.min.css') }}" > 
@endsection
@section('title')
    Permohonan Perubahan
@endsection
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Submit Permohonan Perubahan</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Permohonan Perubahan</a></li>
                        <li class="breadcrumb-item active">Tambah Permohonan</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="card-header">
                    <h2 class="mb-4">Permohonan Perubahan</h2>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="form_permohonan" enctype="multipart/form-data" method="POST" action="{{ route('central-moc-request-add') }}">
                                @csrf
                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white pb-3">
                                        Identitas MOC
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label required">Tanggal Permohonan:</label>
                                                    <input type="date" name="date" class="form-control" id="exampleInputdate" placeholder="Silahkan Pilih" data-provider="flatpickr" data-date-format="d M, Y">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label required">Judul MOC</label>
                                                    <input type="text" name="moc_title" class="form-control @error('moc_title') is-invalid @enderror"  placeholder="Masukan Judul MOC" value="{{ old('moc_title') }}" required>
                                                    @error('moc_title')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label required">Tingkat Resiko</label>
                                                    <select  name="risk_level"  id="risk_level" class="form-select @error('risk_level') is-invalid @enderror" required>
                                                        <option value="">Pilih Resiko</option>
                                                        <option value="1">Low</option>
                                                        <option value="2">Low to Moderate</option>
                                                        <option value="3">Moderate</option>
                                                        <option value="4">Moderate to High</option>
                                                        <option value="5">High</option>
                                                    </select>
                                                    @error('risk_level')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label required">Jenis Perubahan</label>
                                                    <select name="type_of_change[]" id="type_of_change" class="form-select @error('type_of_change') is-invalid @enderror" multiple="multiple" required>
                                                     
                                                        <option value="1" >Instalasi</option>
                                                        <option value="2" >Proses</option>
                                                        <option value="3" >Regulasi</option>
                                                        <option value="4" >Lainnya</option>
                                                    </select>
                                                    @error('type_of_change')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label required">Wilayah</label>
                                                    <select name="region_id"  id="region_id" class="form-select @error('region') is-invalid @enderror" required>
                                                        <option value="">Pilih Wilayah</option>
                                                        @foreach($regions as $region_id=>$name)
                                                            <option {{$region_id == old('$region_id') ? 'selected' : null }} value="{{ $region_id }}">{{ $name }}</option>
                                                        @endforeach 
                                                    </select>
                                                    @error('region_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label required">Area</label>
                                                    <select name="district_id" id="district_id" class="form-select @error('district_id') is-invalid @enderror"  required>
                                                        <option value="">Pilih Area</option>
                                                        
                                                    </select>
                                                    @error('district_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label required">Upload Dokumen Risk Analysis</label>
                                                    <div class="input-group">
                                                        <input name="risk_level_document" type="file" class="form-control">
                                                    </div>
                                                </div>

                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white pb-3">
                                        Detail Perubahan
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label required">Alasan Permintaan Perubahan:</label>
                                            <textarea name="change_reason" id="change_reason" class="form-control @error('change_reason') is-invalid @enderror" rows="4" required>{{ old('change_reason') }}</textarea>
                                            @error('change_reason')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label required">Bagian yang diubah:</label>
                                            <textarea name="changed_parts"  id="changed_parts" class="form-control @error('changed_parts') is-invalid @enderror" rows="4" required>{{ old('changed_parts') }}</textarea>
                                            @error('changed_parts')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                                <div class="card mb-4">
                                    <div class="card-header bg-primary text-white pb-3">
                                        Detail Perubahan
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label required">Diubah Menjadi</label>
                                            <textarea name="changed_to" id="changed_to" class="form-control @error('changed_to') is-invalid @enderror"
                                                       rows="4" required>{{ old('changed_to') }}</textarea>
                                            @error('changed_to')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label required">Referensi Dokumen</label>
                                            <div class="input-group">
                                                <input type="file" name="reference_document" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('central-moc-request-index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left me-2"></i>Kembali
                                    </a>
                                    <div class="btn-group">

                                        <button type="submit" id="btn-add-moc" class="btn btn-success w-md">
                                            <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-add-moc" aria-hidden="true"></span>
                                            <span class="btn-text">Simpan MOC</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')
    <script src="https://digio.pgn.co.id/digio/moc/assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>

            var $btn_add_moc = $("#btn-add-moc");
            var $form = $('#form_permohonan');

            $btn_add_moc.on("click", function (e) {
                e.preventDefault();

                let formData = new FormData($form[0]);

                $("#spinner-add-moc").removeClass("d-none");
                $btn_add_moc.attr("disabled", true);
                $btn_add_moc.find(".btn-text").text("Mohon Tunggu...");

                $.ajax({
                    url: $form.attr('action'),
                    type: 'POST',  
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $("#spinner-add-moc").addClass("d-none");
                        $btn_add_moc.attr("disabled", false);
                        $btn_add_moc.find(".btn-text").text("Simpan");

                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            html: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(function () {
                            window.location.href = "{{ route('central-moc-request-index') }}";
                        });
                    },
                    error: function (error) {
                        $("#spinner-add-moc").addClass("d-none");
                        $btn_add_moc.attr("disabled", false);
                        $btn_add_moc.find(".btn-text").html("Coba Lagi");

                        Swal.fire({
                            icon: "error",
                            title: "WAH!",
                            html:
                                "<h5>Mohon maaf. Terjadi kesalahan</h5> <code>" +
                                (error.responseJSON?.message || 'Terjadi kesalahan tidak diketahui') +
                                "</code>",
                            showConfirmButton: false,
                        });
                    }
                });
            });

            // End Ajax Form

            tinymce.init({
                selector: 'textarea#change_reason',
                relative_urls: false,
                paste_data_images: true,
                image_title: true,
                automatic_uploads: true,
                images_upload_url: './UploadHandler.ashx?userID=zuhrisaifudin57@gmail.com',
                images_upload_base_path: './uploads/gambar_smt_pp/',
                file_picker_types: "image",
                branding: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1:
                    "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                    toolbar2: "print preview media | forecolor backcolor emoticons",
                    // override default upload handler to simulate successful upload
                    file_picker_callback: function(cb, value, meta) {
                        var input = document.createElement("input");
                        input.setAttribute("type", "file");
                        input.setAttribute("accept", "image/*");
                        input.onchange = function() {
                            var file = this.files[0];

                            var reader = new FileReader();
                            reader.readAsDataURL(file);
                            reader.onload = function() {
                                var id = "blobid" + new Date().getTime();
                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(",")[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                        };
                            input.click();
                    },
                    setup: function (editor) {
                        editor.on('init change', function () {
                            editor.save();
                        });
                        editor.on('change', function (e) {
                            document.getElementById();
                            sessform1();
                        });
                    }
            });

            tinymce.init({
                selector: 'textarea#changed_parts',
                relative_urls: false,
                paste_data_images: true,
                image_title: true,
                automatic_uploads: true,
                images_upload_url: './UploadHandler.ashx?userID=zuhrisaifudin57@gmail.com',
                images_upload_base_path: './uploads/gambar_smt_pp/',
                file_picker_types: "image",
                branding: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1:
                    "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                    toolbar2: "print preview media | forecolor backcolor emoticons",
                    // override default upload handler to simulate successful upload
                    file_picker_callback: function(cb, value, meta) {
                        var input = document.createElement("input");
                        input.setAttribute("type", "file");
                        input.setAttribute("accept", "image/*");
                        input.onchange = function() {
                            var file = this.files[0];

                            var reader = new FileReader();
                            reader.readAsDataURL(file);
                            reader.onload = function() {
                                var id = "blobid" + new Date().getTime();
                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(",")[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                        };
                            input.click();
                    },
                    setup: function (editor) {
                        editor.on('init change', function () {
                            editor.save();
                        });
                        editor.on('change', function (e) {
                            document.getElementById();
                            sessform1();
                        });
                    }
            });

            tinymce.init({
                selector: 'textarea#changed_to',
                relative_urls: false,
                paste_data_images: true,
                image_title: true,
                automatic_uploads: true,
                images_upload_url: './UploadHandler.ashx?userID=zuhrisaifudin57@gmail.com',
                images_upload_base_path: './uploads/gambar_smt_pp/',
                file_picker_types: "image",
                branding: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar1:
                    "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
                    toolbar2: "print preview media | forecolor backcolor emoticons",
                    // override default upload handler to simulate successful upload
                    file_picker_callback: function(cb, value, meta) {
                        var input = document.createElement("input");
                        input.setAttribute("type", "file");
                        input.setAttribute("accept", "image/*");
                        input.onchange = function() {
                            var file = this.files[0];

                            var reader = new FileReader();
                            reader.readAsDataURL(file);
                            reader.onload = function() {
                                var id = "blobid" + new Date().getTime();
                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                var base64 = reader.result.split(",")[1];
                                var blobInfo = blobCache.create(id, file, base64);
                                blobCache.add(blobInfo);
                                cb(blobInfo.blobUri(), { title: file.name });
                            };
                        };
                            input.click();
                    },
                    setup: function (editor) {
                        editor.on('init change', function () {
                            editor.save();
                        });
                        editor.on('change', function (e) {
                            document.getElementById('DigioMasterBody_DigioPagesBody_content_moc_diubah_menjadi').value = encodeBase64($('#tampil_diubah_menjadi').val());
                            sessform1();
                        });
                    }
            });
        
            $('#risk_level').select2({
                theme: "bootstrap-5",
                placeholder: 'Silahkan Pilih',
                width: '100%'
            });
            $('#type_of_change').select2({
                theme: "bootstrap-5",
                width: '100%',
                placeholder: 'Silahkan Pilih'
            });
            $('#region_id').select2({
                theme: "bootstrap-5",
                placeholder: 'Pilih Wilayah',
                 width: '100%'
            });
            $('#district_id').select2({
                theme: "bootstrap-5",
                placeholder: 'Pilih Area',
                width: '100%'
            });

            $('#region_id').change(function () {
                var regionID = $(this).val();
                $('#district_id').html('<option value="">Loading...</option>');
                if (regionID) {
                    $.ajax({
                            url: '/districts-by-region/' + regionID,
                            type: 'GET',
                            success: function (data) {
                                $('#district_id').empty();
                                $('#district_id').append('<option value="">Pilih Area</option>');
                                $.each(data, function (key, district) {
                                    $('#district_id').append('<option value="' + district.id + '">' + district.name + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#district_id').html('<option value="">Pilih Area</option>');
                    }
            });

            const formId = 'form_permohonan';

            function saveFormDataToLocalStorage() {
                const form = document.getElementById(formId);
                const formData = {
                    date: form.date.value,
                    moc_title: form.moc_title.value,
                    risk_level: form.risk_level.value,
                    type_of_change: form.type_of_change.value,
                    region: form.region.value,
                    district: form.district.value,
                    change_reason: form.change_reason.value,
                    reference_document: form.reference_document.value

                };
                localStorage.setItem(formId, JSON.stringify(formData));
            }

            function loadFormDataFromLocalStorage() {
                const saved = localStorage.getItem(formId);
                if (saved) {
                    const data = JSON.parse(saved);
                    const form = document.getElementById(formId);
                    form.date.value = data.date || '';
                    form.moc_title.value = data.moc_title || '';
                    form.risk_level.value = data.risk_level || '';
                    form.type_of_change.value = data.type_of_change || '';
                    form.region.value = data.region || '';
                    form.district.value = data.district || '';
                    form.change_reason.value = data.change_reason || '';
                    form.reference_document.value = data.reference_document || '';
                }
            }

            function clearFormDataFromLocalStorage() {
                localStorage.removeItem(formId);
            }

            window.addEventListener('DOMContentLoaded', () => {
                loadFormDataFromLocalStorage();
                document.getElementById(formId).addEventListener('input', saveFormDataToLocalStorage);
            });

    </script>
    <script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection

