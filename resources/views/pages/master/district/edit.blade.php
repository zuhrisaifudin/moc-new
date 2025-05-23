<form id="form-edit-district" action="{{ route('central-edit-district-ajax', Crypt::encryptString($district->id)) }}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label class="form-label">Nama Area</label>
        <select name="region_id" class="form-control form-select" id="">
            @foreach($regions as $region_id=>$name)
                <option {{$region_id == old('$region_id', $district->region_id) ? 'selected' : null }} value="{{ $region_id }}">{{ $name }}</option>
            @endforeach 
        </select>
    </div>

    <div class="mb-3">
        <label for="district_code" class="form-label">Kode Area <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="district_code" value="{{ $district->district_code }}" id="district_code">
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nama Area</label>
        <input type="text" class="form-control" name="name" value="{{ $district->name }}" id="name">
    </div>

    <div class="mb-3">
        <label class="form-label">Status Area</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $district->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{ $district->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-district" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-edit-district" aria-hidden="true"></span>
                <span class="btn-text">Ubah</span>
            </button>
        </div>
    </div>
</form>
