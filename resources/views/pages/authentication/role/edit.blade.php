<form id="form-edit-role" action="{{ route('central-edit-role-ajax', Crypt::encryptString($roles->id)) }}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label for="name" class="form-label">Nama Role</label>
        <input type="text" class="form-control" name="name" value="{{ $roles->name }}" id="name"  disabled>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Display Nama <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="display_name" value="{{ $roles->display_name }}" id="name"  required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi Role <span class="text-danger">*</span></label>
        <textarea type="text" class="form-control" name="description" id="name">{{ $roles->description }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Modul</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $roles->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{ $roles->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-role" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-edit-role" aria-hidden="true"></span>
                <span class="btn-text">Ubah</span>
            </button>
        </div>
    </div>
</form>
