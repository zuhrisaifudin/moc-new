$(document).ready(function(){

    const $datatable_user = $("#datatable-user");

    $datatable = $datatable_user.DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        language: {
            emptyTable: "Belum ada data User.",
            zeroRecords: "Data User tidak ditemukan.",
        },
        ajax: {
            url: $url_get_user,
            type: "POST",
            data: function (data) {
                data._token = $('meta[name="x-token"]').attr("content");

            },
        },
        columns: [
            {
                data: "name",
                name: "users.name",
                orderable: true,
                render: function (data) {
                    return data ? data : '<span class="badge bg-danger-subtle text-danger">-</span>';
                },
            },
            {
                data: "position",
                name: "users.position",
                orderable: true,
                render: function (data) {
                    return data ? data : '<span class="badge bg-danger-subtle text-danger">-</span>';
                },
            },
            {
                data: "email",
                name: "users.email",
                orderable: true,
            },
            {
                data: 'direct_permissions',
                orderable: false,
                searchable: false,
            },
            {
                data: 'permissions_via_roles',
                orderable: false,
                searchable: false,
            },
            {
                data: 'roles',
                orderable: false,
                searchable: false,
                render: function (data) {
                    if (!data || data.trim() === '') {
                        return '<span class="badge bg-danger-subtle text-danger">Tidak ada Role</span>';
                    }
                    const capitalized = data.replace(/\b\w/g, char => char.toUpperCase());
                    return `<span class="badge bg-success-subtle text-success">${capitalized}</span>`;
                }
            },
            {
                data: 'role_count',
                orderable: false,
                searchable: false,
            },
            {
                data: "is_active",
                name: "users.is_active",
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
                data: "option",
                className: "text-center action-item",
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
            url: `${$url_detail_user}/${$val}`,
            method: "GET",
            beforeSend: function () {
                $("#modal-edit-user").modal("show");
            },
            success: function (response) {
                $("#modal-edit-user .modal-body").html(response.content);
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

    $("#modal-edit-user").on("click", "#btn-edit-user", function (e) {
        const $btn = $(this);
        const $spinner = $btn.find("#spinner-edit-user");
        const $btnText = $btn.find(".btn-text");
    
        $("#modal-edit-user")
            .find("#form-edit-user")
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
                    $("#modal-edit-user").modal("hide");
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

    $datatable.on("click", ".delete-item", function (e) {
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
                title: "Hapus User",
                html: "Anda yakin ingin menghapus User ini",
                showCancelButton: true,
                confirmButtonText: "Yakin Hapus",
                cancelButtonText: "Kembali",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    console.log(`${$url_delete_user}/${$val}`);
                    return fetch(`${$url_delete_user}/${$val}`)
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
                            "Mohon maaf. Terjadi kesalahan <br /> <code>" +
                            result.value.message +
                            "</code>",
                        showConfirmButton: false,
                    });
                }
            });
    });

    // Add Role

    $datatable.on("click", ".role-item", function (e) {
        e.preventDefault();
        var $val = $(this).data("id");

        $.ajax({
            url: `${$url_detail_user_role}/${$val}`,
            method: "GET",
            beforeSend: function () {
                $("#modal-role-user").modal("show");
            },
            success: function (response) {
                $("#modal-role-user .modal-body").html(response.content);
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


    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN':  $('meta[name="x-token"]').attr("content")
            }
        });
        $(document).on('click', '.role-checkbox', function () {
            const roleName = $(this).data('role');
            const isChecked = $(this).is(':checked');
            const $val = $(this).closest('#form-edit-user-role').data('id');

            if (!$val) {
                alert("User ID not found!");
                return;
            }
    
            if (isChecked) {
                $.ajax({
                    type:'POST',
                    url: `${$url_attach_user}/${$val}`,
                    data: {
                        role: roleName
                    },
                    success: function(data){
                        Swal.fire({
                            icon: "success",
                            title: "Berhasil",
                            html: 'Role Akses berhasil diberikan',
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        $datatable.ajax.reload();
                        return;
                    }
                })
            }else{
                $.ajax({
                    type:'POST',
                    url: `${$url_detach_user}/${$val}`,
                    data: {
                        role: roleName
                    },
                    success: function(data){
   
                        Swal.fire({
                            icon: "error",
                            title: "WAH!",
                            html: 'Role Akses berhasil dicabut',
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        $datatable.ajax.reload();
                        return;
                    }
                })
            }
        });
    });

});
