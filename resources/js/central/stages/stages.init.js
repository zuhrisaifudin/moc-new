$(document).ready(function(){

    var $datatable_stages = $("#datatable-stages");
    var $btn_add_stages = $("#btn-add-stages");

    $datatable = $datatable_stages.DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        language: {
            emptyTable: "Belum ada Tahapan.",
            zeroRecords: "Tahapan tidak ditemukan.",
        },
        ajax: {
            url: $url_get_stages,
            type: "POST",
            data: function (data) {
                data._token = $('meta[name="x-token"]').attr("content");
            },
        },
        columns: [
            {
                data: "stages_name",
                name: "stages.stages_name",
                orderable: false,
                render: function (data) {
                    if (!data) {
                        return (
                            '<span style="padding:5px 10px;"  class="badge bg-danger-subtle text-danger">-</span>'
                        );
                    }
                    return (
                        data
                    );
                },
            },
            {
                data: "type_form",
                name: "stagess.type_form",
                orderable: false,
                render: function (data, type, item) {
                    if (item.type_form == 1) {
                        return '<span class="badge bg-danger-subtle text-danger">Form 2</span>';
                    } else {
                        return ' <span class="badge  badge bg-success-subtle text-success">Form 3</span>';
                    }
                },
            },
            {
                data: "is_active",
                name: "stagess.is_active",
                orderable: false,
                searchable: false,
                render: function (data, type, item) {
                    if (item.is_active == 0) {
                        return '<span class="badge bg-danger-subtle text-danger">Tidak Aktif</span>';
                    } else {
                        return ' <span class="badge  badge bg-success-subtle text-success">Aktif</span>';
                    }
                },
            },
            {
                data: 'option',
                orderable: false,
                searchable: false,
            },
        ],
        order: [[0, "asc"]],
        drawCallback: function (settings) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }

    });

    $btn_add_stages.on("click", function (e) {
        $('#form-add-stages').ajaxForm({
            clearForm: true,
            beforeSubmit: function () {
                $("#spinner-add-stages").removeClass("d-none");
                $btn_add_stages.attr("disabled", true);
                $btn_add_stages.find(".btn-text").text("Mohon Tunggu...");
            },
            success: function (response) {
                $("#spinner-add-stages").addClass("d-none");
                $btn_add_stages.attr("disabled", false);
                $btn_add_stages.find(".btn-text").text("Simpan");

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    html: response.message,
                    showConfirmButton: false,
                    timer: 2000,
                });

                $("#modal-add-stages").modal("hide");
                $datatable.ajax.reload();
            },
            error: function (error) {
                $("#spinner-add-stages").addClass("d-none");
                $btn_add_stages.attr("disabled", false);
                $btn_add_stages.find(".btn-text").html("Coba Lagi");

                Swal.fire({
                    icon: "error",
                    title: "WAH!",
                    html:
                        "<h5>Mohon maaf. Terjadi kesalahan</h5> <code>" +
                        error.responseJSON.message +
                        "</code>",
                    showConfirmButton: false,
                });
            },

        });
    });

    $datatable.on("click", ".edit-item", function (e) {
        e.preventDefault();
        var $val = $(this).data("id");

        $.ajax({
            url: `${$url_detail_stages}/${$val}`,
            method: "GET",
            beforeSend: function () {
                $("#modal-edit-stages").modal("show");
            },
            success: function (response) {
                $("#modal-edit-stages .modal-body").html(response.content);
            },
            error: function (error) {
                let message = "";
                if (error.responseJSON.code === 2000) {
                    message = error.responseJSON.message;
                } else {
                    message =
                        "<h5>Mohon maaf. Terjadi kesalahan</h5> <code>" +
                        error.responseJSON.message +
                        "</code>";
                }
                Swal.fire({
                    icon: "error",
                    title: "WAH!",
                    html: message,
                    showConfirmButton: false,
                });
            },
        });
    });

    $("#modal-edit-stages").on("click", "#btn-edit-stages", function (e) {
        const $btn = $(this);
        const $spinner = $btn.find("#spinner-edit-stages");
        const $btnText = $btn.find(".btn-text");
    
        $("#modal-edit-stages")
            .find("#form-edit-stages")
            .ajaxForm({
                beforeSubmit: function () {
                    $spinner.removeClass("d-none");
                    $btnText.text("Mohon Tunggu...");
                    $btn.attr("disabled", true);
                },
                success: function (response) {
                    $spinner.addClass("d-none");
                    $btnText.text("Ubah");
                    $btn.attr("disabled", false);
    
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        html: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $("#modal-edit-stages").modal("hide");
                    $datatable.ajax.reload();
                },
                error: function (error) {
                    $spinner.addClass("d-none");
                    $btnText.text("Coba Lagi");
                    $btn.attr("disabled", false);
    
                    Swal.fire({
                        icon: "error",
                        title: "WAH!",
                        html:
                            "<h5>Mohon maaf. Terjadi kesalahan</h5> <code>" +
                            error.responseJSON.message +
                            "</code>",
                        showConfirmButton: false,
                    });
                },
            });
    });
    
    $datatable_stages.on("click", ".delete-item", function (e) {
        e.preventDefault();
        var $val = $(this).data("id");

        Swal.mixin({
            customClass: {
                confirmButton: "btn btn-danger waves-effect waves-light mx-3",
                cancelButton: "btn btn-success waves-effect waves-light",
            },
            buttonsStyling: false,
        })
            .fire({
                icon: "warning",
                title: "Hapus stages",
                html: "Anda yakin ingin menghapus stages ini",
                showCancelButton: true,
                confirmButtonText: "Yakin Hapus",
                cancelButtonText: "Kembali",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    console.log(`${$url_delete_stages}/${$val}`);
                    return fetch(`${$url_delete_stages}/${$val}`)
                        .then((response) => {
                            return response.json();
                        })
                        .catch((err) => {
                            Swal.showValidationMessage(err);
                        });
                },
                allowOutsideClick: () => !Swal.isLoading(),
            })
            .then((result) => {
                if (result.isConfirmed) {
                    if (result.value.code === 1000) {
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            html: result.value.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        $datatable.ajax.reload();
                        return;
                    }

                    Swal.fire({
                        icon: "error",
                        title: "WAH!",
                        html:
                            "<h5>Mohon maaf. Terjadi kesalahan</h5> <code>" +
                            result.value.message +
                            "</code>",
                        showConfirmButton: false,
                    });
                }
            });
    });

});
