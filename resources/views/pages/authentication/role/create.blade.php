<form id="form-add-role" action="{{ route('central-add-role-ajax')}}" method="POST">
    {{ csrf_field() }}
    
    <div class="mb-3">
        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Masukan Nama Role" required>
    </div>

    <div class="mb-3">
        <label for="display_name" class="form-label">Display Nama</label>
        <input type="text" class="form-control" name="display_name" value="{{ old('display_name') }}" id="display_name" placeholder="Masukan Display Nama Role" required>

    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea type="text" class="form-control" name="description" id="description" placeholder="Masukan Deskripsi Role" required></textarea>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-add-role" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-add-role" aria-hidden="true"></span>
                <span class="btn-text">Simpan</span>
            </button>
        </div>
    </div>
</form>
