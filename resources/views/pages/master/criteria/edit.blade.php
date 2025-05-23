<form id="form-edit-criteria" action="{{ route('central-edit-criteria-ajax', Crypt::encryptString($criteria->id)) }}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label for="criteria_name" class="form-label">Nama Kriteria</label>
        <input type="text" class="form-control" name="criteria_name" value="{{ $criteria->criteria_name }}" id="criteria_name">
    </div>

    <div class="mb-3">
        <label class="form-label">Status Kriteria</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $criteria->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{ $criteria->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-criteria" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-edit-criteria" aria-hidden="true"></span>
                <span class="btn-text">Ubah</span>
            </button>
        </div>
    </div>
</form>
