<form id="form-edit-permission" action="{{ route('central-edit-permission-ajax', Crypt::encryptString($permission->id)) }}" method="POST">
    {{ csrf_field() }}
    <div class="mb-3">
        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" value="{{ $permission->name }}" id="name" readonly disabled>
    </div>

    <div class="mb-3">
        <label for="display_name" class="form-label">Display Nama</label>
        <input type="text" class="form-control" name="display_name" value="{{ $permission->display_name }}" id="display_name" placeholder="Masukan Display Nama" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <input type="text" class="form-control" name="description" value="{{ $permission->description }}" id="description" placeholder="Masukan Deskripsi" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Modul</label>
        <select name="module_id" class="form-control form-select" id="module_id" readonly disabled>
            @foreach($module as $module_id=>$module_name)
                <option {{$module_id == $permission->module_id ? 'selected' : null }} value="{{ $module_id }}">{{ $module_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Modul</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $permission->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{ $permission->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>

    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-permission" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-edit-permission" aria-hidden="true"></span>
                <span class="btn-text">Ubah</span>
            </button>
        </div>
    </div>
</form>
