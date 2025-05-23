$(document).ready(function(){

    var $datatable_permission = $("#datatable-permission");
    var $btn_add_permission = $("#btn-add-permission");
    var $filter_status_module = $("#filter-status-module");

    $filter_status_module.change(function () {
        $datatable.draw();
    });

    $datatable = $datatable_permission.DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        language: {
            emptyTable: "Belum ada Permission.",
            zeroRecords: "Permission tidak ditemukan.",
        },
        ajax: {
            url: $url_get_permission,
            type: "POST",
            data: function (data) {
                data._token = $('meta[name="x-token"]').attr("content");
                data.module = $filter_status_module.val();
            },
        },
        columns: [
            {
                data: "id",
                name: "permissions.id",
                visible: false,
            },
            {
                data: "module.name",
                name: "module.name",
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
                data: "name",
                name: "permissions.name",
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
                data: "display_name",
                name: "permissions.display_name",
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
                data: "guard_name",
                name: "permissions.guard_name",
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
                data: "description",
                name: "permissions.description",
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
                data: "is_active",
                name: "permissions.is_active",
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

    });

    $btn_add_permission.on("click", function (e) {
        $('#form-add-permission').ajaxForm({
            clearForm: true,
            beforeSubmit: function () {
                $("#spinner-add-permission").removeClass("d-none");
                $btn_add_permission.attr("disabled", true);
                $btn_add_permission.find(".btn-text").text("Mohon Tunggu...");
            },
            success: function (response) {
                $("#spinner-add-permission").addClass("d-none");
                $btn_add_permission.attr("disabled", false);
                $btn_add_permission.find(".btn-text").text("Simpan");

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    html: response.message,
                    showConfirmButton: false,
                    timer: 2000,
                });

                $("#modal-add-permission").modal("hide");
                $datatable.ajax.reload();
            },
            error: function (error) {
                $("#spinner-add-permission").addClass("d-none");
                $btn_add_permission.attr("disabled", false);
                $btn_add_permission.find(".btn-text").html("Coba Lagi");

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
            url: `${$url_detail_permission}/${$val}`,
            method: "GET",
            beforeSend: function () {
                $("#modal-edit-permission").modal("show");
            },
            success: function (response) {
                $("#modal-edit-permission .modal-body").html(response.content);
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

    $("#modal-edit-permission").on("click", "#btn-edit-permission", function (e) {
        const $btn = $(this);
        const $spinner = $btn.find("#spinner-edit-permission");
        const $btnText = $btn.find(".btn-text");
    
        $("#modal-edit-permission")
            .find("#form-edit-permission")
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
                    $("#modal-edit-permission").modal("hide");
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
    
    $datatable_permission.on("click", ".delete-item", function (e) {
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
                title: "Hapus Permission",
                html: "Anda yakin ingin menghapus Permission ini",
                showCancelButton: true,
                confirmButtonText: "Yakin Hapus",
                cancelButtonText: "Kembali",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    console.log(`${$url_delete_permission}/${$val}`);
                    return fetch(`${$url_delete_permission}/${$val}`)
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
