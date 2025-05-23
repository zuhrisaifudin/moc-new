<form id="form-add-stages" action="{{ route('central-add-stages-ajax')}}" method="POST">
    {{ csrf_field() }}
    
    <div class="mb-3">
        <label for="stages_name" class="form-label">Nama Tahapan <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="stages_name" value="{{ old('stages_name') }}" id="stages_name" placeholder="Masukan Nama Tahapan" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipe Form</label>
        <select class="form-control form-select" name="type_form">
            <option value="" disabled selected hidden >Pilihan</option>
            <option value="1">Form 2</option>
            <option value="2">Form 3</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Tahapan</label>
        <select class="form-control form-select" name="is_active">
            <option value="" disabled selected hidden >Pilihan</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-add-stages" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-add-stages" aria-hidden="true"></span>
                <span class="btn-text">Simpan</span>
            </button>
        </div>
    </div>
</form>
