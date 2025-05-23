<div class="hstack gap-2">
    <a href="{{ route('central-edit-role-page', $id) }}" class="btn btn-sm btn-subtle-info"  data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Kriteria Perubahan {{ $name }}">
        <i class=" ri-play-list-add-fill align-bottom"></i>
    </a>
    @can('edit-stage')
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-primary edit-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Tahapan {{ $name }}">
        <i class="ri-pencil-fill align-bottom"></i>
    </button>
    @endcan
    @can('delete-stage')
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-danger delete-item"  data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Tahapan {{ $name }}">
        <i class="ri-delete-bin-5-fill align-bottom"></i>
    </button>
    @endcan
   
</div>


