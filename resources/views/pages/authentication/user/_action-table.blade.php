<div class="hstack gap-2">
    @can('add-role-user')
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-primary role-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Role untuk  {{ $name }}">
        <i class=" ri-lock-unlock-line align-bottom"></i>
    </button>
    @endcan
    @can('edit-user')
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-secondary edit-item " data-bs-toggle="tooltip" data-bs-placement="top" title="Edit {{ $name }}">
        <i class="ri-pencil-fill align-bottom"></i>
    </button>
    @endcan
    @can('edit-user')
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-danger delete-item"  data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus {{ $name }}">
        <i class="ri-delete-bin-5-fill align-bottom"></i>
    </button>
    @endcan
    @can('add-permission-user')
    <a href="{{ route('central-edit-user-page', $id) }}" class="btn btn-sm btn-subtle-info"  data-bs-toggle="tooltip" data-bs-placement="top" title="Atur Hak Akses {{ $name }}">
        <i class="ri-shield-keyhole-line align-bottom"></i>
    </a>
    @endcan
</div>