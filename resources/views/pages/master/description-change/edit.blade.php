<form id="form-edit-description-change" action="{{ route('central-edit-description-change-ajax', Crypt::encryptString($description->id)) }}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label class="form-label">Kriteria</label>
        <select name="criteria_id" class="form-control form-select" id="criteria_id">
            @foreach($criteria as $criteria_id=>$criteria_name)
                <option  value="{{ $criteria_id }}" {{ $criteria_id == old('$criteria_id' , $description->criteria_id ) ? 'selected' : null }}>{{ $criteria_name }}</option>
            @endforeach 
        </select>
    </div>

    <div class="mb-3">
        <label for="description_change_name" class="form-label">Nama Deskripsi</label>
        <textarea type="text" class="form-control" name="description_change_name" id="description_change_name">{{ $description->description_change_name }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Kriteria</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $description->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{ $description->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-description-change" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-edit-description-change" aria-hidden="true"></span>
                <span class="btn-text">Ubah</span>
            </button>
        </div>
    </div>
</form>
