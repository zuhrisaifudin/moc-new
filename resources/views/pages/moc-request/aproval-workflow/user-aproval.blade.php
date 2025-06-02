<table id="datatable-user-approval" class="table nowrap table-hover align-middle" style="width:100%">
    <thead class="table-light">
    <tr>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Pilih</th>
    </tr>
    </thead>
</table>

<script>
    $(document).ready(function () {
        $('#datatable-user-approval').DataTable({
            processing: true,
            serverSide: true,
            language: {
                emptyTable: "Belum ada Kendali Approval",
                zeroRecords: "Kendali Approval tidak ditemukan.",
            },
            ajax: {
                url: '{{ route('central-get-user-approval-ajax') }}', 
                type: "POST",
                data: function (data) {
                    data._token = $('meta[name="x-token"]').attr("content");
                },
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'position', name: 'position' },
                {
                    data: 'id',
                    name: 'pilih',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `<button class="btn btn-sm btn-primary pilih-approval" 
                                data-id="${data}" 
                                data-name="${row.name}" 
                                data-position="${row.position}">
                            Pilih
                        </button>`;
                    }
                }
            ],
            responsive: true,
            scrollX: true,
            info: false,
            lengthChange: false,
        });
    });
</script>
