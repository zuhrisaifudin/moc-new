$(document).ready(function(){

    var $datatable_description_change = $("#datatable-description-change");
    var $btn_add_description_change = $("#btn-add-description-change");

    $datatable = $datatable_description_change.DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        language: {
            emptyTable: "Belum ada Deskripsi Perubahan.",
            zeroRecords: "Deskripsi Perubahan tidak ditemukan.",
        },
        ajax: {
            url: $url_get_description_change,
            type: "POST",
            data: function (data) {
                data._token = $('meta[name="x-token"]').attr("content");
            },
        },
        columns: [
            {
                data: "description_change_name",
                name: "description_changes.description_change_name",
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
                data: "criteria",
                name: "criteria",
                orderable: false,
                render: function (data, type, item) {
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
                data: "is_active",
                name: "description_changes.is_active",
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

    $btn_add_description_change.on("click", function (e) {
        $('#form-add-description-change').ajaxForm({
            clearForm: true,
            beforeSubmit: function () {
                $("#spinner-add-description-change").removeClass("d-none");
                $btn_add_description_change.attr("disabled", true);
                $btn_add_description_change.find(".btn-text").text("Mohon Tunggu...");
            },
            success: function (response) {
                $("#spinner-add-description-change").addClass("d-none");
                $btn_add_description_change.attr("disabled", false);
                $btn_add_description_change.find(".btn-text").text("Simpan");

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    html: response.message,
                    showConfirmButton: false,
                    timer: 2000,
                });

                $("#modal-add-description-change").modal("hide");
                $datatable.ajax.reload();
            },
            error: function (error) {
                $("#spinner-add-description-change").addClass("d-none");
                $btn_add_description_change.attr("disabled", false);
                $btn_add_description_change.find(".btn-text").html("Coba Lagi");

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
            url: `${$url_detail_description_change}/${$val}`,
            method: "GET",
            beforeSend: function () {
                $("#modal-edit-description-change").modal("show");
            },
            success: function (response) {
                $("#modal-edit-description-change .modal-body").html(response.content);
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

    $("#modal-edit-description-change").on("click", "#btn-edit-description-change", function (e) {
        const $btn = $(this);
        const $spinner = $btn.find("#spinner-edit-description-change");
        const $btnText = $btn.find(".btn-text");
    
        $("#modal-edit-description-change")
            .find("#form-edit-description-change")
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
                    $("#modal-edit-description-change").modal("hide");
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
    
    $datatable_description_change.on("click", ".delete-item", function (e) {
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
                title: "Hapus Deskripsi Perubahan",
                html: "Anda yakin ingin menghapus Deskripsi Perubahan ini",
                showCancelButton: true,
                confirmButtonText: "Yakin Hapus",
                cancelButtonText: "Kembali",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    console.log(`${$url_delete_description_change}/${$val}`);
                    return fetch(`${$url_delete_description_change}/${$val}`)
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
