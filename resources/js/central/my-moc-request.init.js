$(document).ready(function(){

    const $datatable_moc_request = $("#datatable-moc-request");
    var $filter_status_perubahan = $("#filter-status-perubahan");

    $filter_status_perubahan.change(function () {
        $datatable.draw();
    });

    $datatable = $datatable_moc_request.DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        language: {
            emptyTable: "Belum ada data MOC.",
            zeroRecords: "Data MOC tidak ditemukan.",
        },
        ajax: {
            url: $url_get_my_moc_request,
            type: "POST",
            data: function (data) {
                data.is_temporary = $filter_status_perubahan.val();
                data._token = $('meta[name="x-token"]').attr("content");

            },
        },
        columns: [
            {
                data: "option",
                className: "text-center action-item",
                orderable: false,
                searchable: false,
            },
            {
                data: "moc_number",
                name: "moc_requests.moc_number",
                orderable: true,
                render: function (data) {
                    return data ? data : '<span class="badge bg-danger-subtle text-danger">-</span>';
                },
            },
            {
                data: "moc_title",
                name: "moc_requests.moc_title",
                orderable: true,
            },
            {
                data: "status",
                name: "moc_requests.status",
                orderable: false,
                render: function (data) {
                    if (!data) return "-";

                    const stages = {
                        1: "Pending",
                        2: "Submission",
                        3: "Approved",
                        4: "Reject",
                    };

                    const badgeClasses = {
                        1: "secondary",
                        2: "primary",
                        3: "success",
                        4: "danger",
                    };

                    const stageLabel = stages[data] || `Stage ${data}`;
                    const badgeClass = badgeClasses[data] || "dark";

                    return `<span class="badge bg-${badgeClass}">${stageLabel}</span>`;
                },
            },
            {
                data: "type_of_change",
                name: "moc_requests.type_of_change",
                orderable: false,
                render: function(data) {
                    if (!Array.isArray(data)) {
                        try {
                            data = JSON.parse(data);
                        } catch {
                            return '<span class="badge bg-light text-dark">Data tidak valid</span>';
                        }
                    }
                
                    // Mapping tipe perubahan ke label dan class badge
                    const typeLabels = {
                        1: {text: 'Instalasi', class: 'bg-primary text-white'},
                        2: {text: 'Proses', class: 'bg-warning text-dark'},
                        3: {text: 'Regulasi', class: 'bg-info text-white'},
                        4: {text: 'Lainnya', class: 'bg-secondary text-white'}
                    };
                
                    // Buat badge untuk tiap tipe
                    let badges = data.map(item => {
                        const tipe = parseInt(item);
                        if (typeLabels[tipe]) {
                            return `<span class="badge ${typeLabels[tipe].class} me-1">${typeLabels[tipe].text}</span>`;
                        }
                        return `<span class="badge bg-light text-dark">Tidak diketahui</span>`;
                    });
                
                    return badges.join(' ');
                }  
                
            },            
            {
                data: "risk_level",
                name: "moc_requests.risk_level",
                orderable: false,
                render: function (data) {
                    const typeLabels = {
                        1: {text: 'Low', class: 'bg-low text-white'},
                        2: {text: 'Low to Moderate', class: 'bg-low-moderate text-white'},
                        3: {text: 'Moderate', class: 'bg-moderate  text-dark'},
                        4: {text: 'Moderate to High', class: 'bg-moderate-high text-white'},
                        5: {text: 'High', class: 'bg-high text-white'}
                    };

                    const tipe = parseInt(data);
                    if (typeLabels[tipe]) {
                        return `<span class="badge ${typeLabels[tipe].class} me-1">${typeLabels[tipe].text}</span>`;
                    }
                    return `<span class="badge bg-light text-dark">Tidak diketahui</span>`;
                            
                 }
            },
            {
                data: "proposed_by",
                name: "moc_requests.proposed_by",
                orderable: false,
            },
            {
                data: "region_name",
                name: "moc_requests.region_name",
                orderable: false,
            },
            {
                data: "district_name",
                name: "moc_requests.district_name",
                orderable: false,
            },
            {
                data: "date",
                name: "moc_requests.date",
                orderable: true,
                render: function (data) {
                    if (!data) return "-";

                    const date = new Date(data);
                    const options = { day: '2-digit', month: 'short', year: 'numeric' };
                    return date.toLocaleDateString('id-ID', options).replace('.', '');
                },
            },
            {
                data: "current_stage",
                name: "moc_requests.current_stage",
                orderable: false,
                render: function (data) {
                    if (!data) return "-";

                    const stages = {
                        1: "Pending",
                        2: "Submission",
                        3: "Review",
                        4: "Checklist 1",
                        5: "Checklist 2",
                        6: "Approval",
                        7: "Closed"
                    };

                    const badgeClasses = {
                        1: "secondary",
                        2: "primary",
                        3: "info",
                        4: "warning",
                        5: "warning",
                        6: "success",
                        7: "dark"
                    };

                    const stageLabel = stages[data] || `Stage ${data}`;
                    const badgeClass = badgeClasses[data] || "dark";

                    return `<span class="badge bg-${badgeClass}">${stageLabel}</span>`;
                },
            },
            {
                data: "is_temporary",
                name: "moc_requests.is_temporary",
                orderable: false,
                render: function (data) {
                    if (data === null || data === undefined) {
                        return '<span class="badge bg-dark-subtle text-dark">-</span>';
                    }
                    return data
                        ? '<span class="badge bg-warning-subtle text-warning">Sementara</span>'
                        : '<span class="badge bg-secondary-subtle text-secondary">Permanent</span>';
                },
            },
            {
                data: "reference_document",
                name: "moc_requests.reference_document",
                orderable: false,
                render: function (data) {
                    return data ? `<a href="${data}" target="_blank">Lihat Dokumen</a>` : "-";
                }
            },
            {
                data: "risk_level_document",
                name: "moc_requests.risk_level_document",
                orderable: false,
                render: function (data) {
                    return data ? `<a href="${data}" target="_blank">Lihat Dokumen</a>` : "-";
                }
            },
            
        ],
        order: [[7, "desc"]],
        drawCallback: function (settings) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });

    

});
