<form id="form-edit-region" action="{{ route('central-edit-region-ajax', Crypt::encryptString($region->id)) }}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label for="region_code" class="form-label">Kode Wilayah <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="region_code" value="{{ $region->region_code }}" id="region_code">
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama Wilayah</label>
        <input type="text" class="form-control" name="name" value="{{ $region->name }}" id="name">
    </div>

    <div class="mb-3">
        <label class="form-label">Status Wilayah</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $region->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{ $region->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-region" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-edit-region" aria-hidden="true"></span>
                <span class="btn-text">Ubah</span>
            </button>
        </div>
    </div>
</form>
