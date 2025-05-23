<form id="form-add-region" action="{{ route('central-add-region-ajax')}}" method="POST">
    {{ csrf_field() }}

   
    <div class="mb-3">
        <label for="region_code" class="form-label">Kode  Wilayah <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="region_code" value="{{ old('region_code') }}" id="region_code" placeholder="Masukan Kode Wilayah" required>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama Wilayah <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Masukan Nama Wilayah" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Wilayah</label>
        <select class="form-control form-select" name="is_active">
            <option value="" disabled selected hidden >Pilihan</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-add-region" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-add-region" aria-hidden="true"></span>
                <span class="btn-text">Simpan</span>
            </button>
        </div>
    </div>
</form>
