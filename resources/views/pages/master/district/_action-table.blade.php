<div class="hstack gap-2">
    @can('edit-district')
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-primary edit-item" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Wilayah {{ $name }}">
        <i class="ri-pencil-fill align-bottom"></i>
    </button>
    @endcan
    @can('delete-district')
    <button data-id="{{ $id }}" class="btn btn-sm btn-subtle-danger delete-item"  data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Wilayah {{ $name }}">
        <i class="ri-delete-bin-5-fill align-bottom"></i>
    </button>
    @endcan
   
</div>


