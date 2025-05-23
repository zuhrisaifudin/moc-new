<form id="form-edit-stages" action="{{ route('central-edit-stages-ajax', Crypt::encryptString($stages->id)) }}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label for="stages_name" class="form-label">Nama Tahapan</label>
        <input type="text" class="form-control" name="stages_name" value="{{ $stages->stages_name }}" id="stages_name">
    </div>

    <div class="mb-3">
        <label class="form-label">Tipe Form</label>
        <select class="form-control form-select" name="type_form">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $stages->type_form == "1" ? 'selected' : null }}>Form 2</option>
            <option value="2" {{ $stages->type_form == "2" ? 'selected' : null }}>Form 3</option>
        </select>
    </div>


    <div class="mb-3">
        <label class="form-label">Status Tahapn</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $stages->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{ $stages->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-stages" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-edit-stages" aria-hidden="true"></span>
                <span class="btn-text">Ubah</span>
            </button>
        </div>
    </div>
</form>
