<div class="hstack gap-2">
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-primary edit-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit {{ $name }}">
        <i class="ri-pencil-fill align-bottom"></i>
    </button>
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-danger delete-item"  data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus {{ $name }}">
        <i class="ri-delete-bin-5-fill align-bottom"></i>
    </button>
    <a href="{{ route('central-edit-role-page', $id) }}" class="btn btn-sm btn-subtle-info"  data-bs-toggle="tooltip" data-bs-placement="top" title="Atur Hak Akses {{ $name }}">
        <i class="ri-shield-keyhole-line align-bottom"></i>
    </a>
</div>


