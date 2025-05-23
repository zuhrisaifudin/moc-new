<form id="form-edit-user" action="{{ route('central-edit-user-ajax', Crypt::encryptString($user->id)) }}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label for="email" class="form-label">Display Nama <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="email" disabled>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama </label>
        <input type="text" class="form-control" name="name" value="{{ $user->name }}" id="name">
    </div>


    <div class="mb-3">
        <label class="form-label">Status Modul</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $user->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{ $user->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-user" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-edit-user" aria-hidden="true"></span>
                <span class="btn-text">Ubah</span>
            </button>
        </div>
    </div>
</form>
