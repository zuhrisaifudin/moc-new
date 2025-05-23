$(document).ready(function(){

    const $datatable_module = $("#datatable-module");
    const $btn_edit_module =$("#btn-edit-module");

    $datatable = $datatable_module.DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        language: {
            emptyTable: "Belum ada Sistem Module.",
            zeroRecords: "Sistem Module tidak ditemukan.",
        },
        ajax: {
            url: $url_get_module,
            type: "POST",
            data: function (data) {
                data._token = $('meta[name="x-token"]').attr("content");
            },
        },
        columns: [
            {
                data: "id",
                name: "modules.id",
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "modules.name",
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
            },{
                data: "description",
                name: "modules.description",
                orderable: false,
            },
            {
                data: 'permission_count',
                className: "text-center acton-item",
                orderable: false,
                searchable: false,
            },
            {
                data: "core",
                name: "modules.core",
                orderable: false,
                searchable: false,
                render: function (data, type, item) {
                    if (item.core == 0) {
                        return '<span class="badge bg-danger-subtle text-danger">Tidak</span>';
                    } else {
                        return ' <span class="badge bg-success-subtle text-success">Iya</span>';
                    }
                },
            },
            {
                data: "is_active",
                name: "modules.is_active",
                orderable: false,
                searchable: false,
                render: function (data, type, item) {
                    if (item.is_active == 0) {
                        return '<span class="badge bg-danger-subtle text-danger">Tidak Aktif</span>';
                    } else {
                        return ' <span class="badge bg-success-subtle text-success">Aktif</span>';
                    }
                },
            },
            {
                data: 'option',
                className: "text-center",
                orderable: false,
                searchable: false,
            },
        ],
        order: [[0, "desc"]],
        drawCallback: function (settings) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }

    });

    $datatable.on("click", ".edit-item", function (e) {
        e.preventDefault();
        var $val = $(this).data("id");

        $.ajax({
            url: `${$url_detail_module}/${$val}`,
            method: "GET",
            beforeSend: function () {
                $("#modal-edit-module").modal("show");
            },
            success: function (response) {
                $("#modal-edit-module .modal-body").html(response.content);
            },
            error: function (error) {
                let message = "";
                if (error.responseJSON.code === 2000) {
                    message = error.responseJSON.message;
                } else {
                    message =
                        "Mohon maaf. Terjadi kesalahan <br /> <code>" +
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

    $datatable.on("click", ".show-item", function (e) {
        e.preventDefault();
        var $val = $(this).data("id");

        $.ajax({
            url: `${$url_show_module}/${$val}`,
            method: "GET",
            beforeSend: function () {
                $("#modal-show-module").modal("show");
            },
            success: function (response) {
                $("#modal-show-module .modal-body").html(response.content);
            },
            error: function (error) {
                let message = "";
                if (error.responseJSON.code === 2000) {
                    message = error.responseJSON.message;
                } else {
                    message =
                        "Mohon maaf. Terjadi kesalahan <br /> <code>" +
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

    

    $("#modal-edit-module").on("click", "#btn-edit-module", function (e) {
        $("#modal-edit-module")
            .find("#form-edit-module")
            .ajaxForm({
                beforeSubmit: function () {
                    $btn_edit_module
                        .html(
                            "<i class='bx bx-hourglass bx-spin font-size-16 align-middle me-2'></i>  Mohon Tunggu"
                        )
                        .attr("disabled", true);
                },
                success: function (response) {
                    $btn_edit_module.html("Simpan").attr("disabled", false);
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        html: response.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $("#modal-edit-module").modal("hide");
                    $datatable.ajax.reload();
                },
                error: function (error) {
                    $btn_edit_module
                        .html("<i class='bx bx-reset'></i> Coba lagi")
                        .attr("disabled", false);
                    Swal.fire({
                        icon: "error",
                        title: "WAH!",
                        html:
                            "Mohon maaf. Terjadi kesalahan <br /> <code>" +
                            error.responseJSON.message +
                            "</code>",
                        showConfirmButton: false,
                    });
                },
            });
    });

});
