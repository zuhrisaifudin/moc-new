$(document).ready(function(){

    var $datatable_role = $("#datatable-role");
    var $btn_add_role = $("#btn-add-role");

    $datatable = $datatable_role.DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        language: {
            emptyTable: "Belum ada Roles Akses.",
            zeroRecords: " Roles Akses tidak ditemukan.",
        },
        ajax: {
            url: $url_get_role,
            type: "POST",
            data: function (data) {
                data._token = $('meta[name="x-token"]').attr("content");
            },
        },
        columns: [
            {
                data: "name",
                name: "roles.name",
                orderable: false,
                render: function (data) {
                    if (!data) {
                        return (
                            '<span style="padding:5px 10px;"  class="badge bg-danger-subtle text-danger">-</span>'
                        );
                    }
                    return (
                        '<span style="padding:5px 10px;"  class="badge bg-primary-subtle text-primary text-uppercase">' +
                        data +
                        "</span>"
                    );
                },
            },
            {
                data: 'display_name',
                name: "roles.display_name",
                orderable: false,
                searchable: false,
            },
            {
                data: 'count_permission',
                orderable: false,
                searchable: false,
            },
            
            {
                data: "guard_name",
                name: "roles.guard_name",
                searchable: false,
                orderable: false,
            },
            {
                data: "is_active",
                name: "roles.is_active",
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
            }
        ],
        order: [[0, "asc"]],
        drawCallback: function (settings) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }

    });

    $btn_add_role.on("click", function (e) {
        $('#form-add-role').ajaxForm({
            clearForm: true,
            beforeSubmit: function () {
                $("#spinner-add-role").removeClass("d-none");
                $btn_add_role.attr("disabled", true);
                $btn_add_role.find(".btn-text").text("Mohon Tunggu...");
            },
            success: function (response) {
                $("#spinner-add-role").addClass("d-none");
                $btn_add_role.attr("disabled", false);
                $btn_add_role.find(".btn-text").text("Simpan");

                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    html: response.message,
                    showConfirmButton: false,
                    timer: 2000,
                });

                $("#modal-add-role").modal("hide");
                $datatable.ajax.reload();
            },
            error: function (error) {
                $("#spinner-add-role").addClass("d-none");
                $btn_add_role.attr("disabled", false);
                $btn_add_role.find(".btn-text").html("Coba Lagi");

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
            url: `${$url_detail_role}/${$val}`,
            method: "GET",
            beforeSend: function () {
                $("#modal-edit-role").modal("show");
            },
            success: function (response) {
                $("#modal-edit-role .modal-body").html(response.content);
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

    $("#modal-edit-role").on("click", "#btn-edit-role", function (e) {
        const $btn = $(this);
        const $spinner = $btn.find("#spinner-edit-role");
        const $btnText = $btn.find(".btn-text");
    
        $("#modal-edit-role")
            .find("#form-edit-role")
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
                    $("#modal-edit-role").modal("hide");
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
    
    $datatable_role.on("click", ".delete-item", function (e) {
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
                title: "Hapus Role",
                html: "Anda yakin ingin menghapus Role ini",
                showCancelButton: true,
                confirmButtonText: "Yakin Hapus",
                cancelButtonText: "Kembali",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    console.log(`${$url_delete_role}/${$val}`);
                    return fetch(`${$url_delete_role}/${$val}`)
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
