<form id="form-add-description-change" action="{{ route('central-add-description-change-ajax')}}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label class="form-label">Tahap</label>
        <select name="criteria_id" class="form-control form-select" id="criteria_id">
            @foreach($criteria as $criteria_id=>$criteria_name)
                <option {{$criteria_id == old('$criteria_id') ? 'selected' : null }} value="{{ $criteria_id }}">{{ $criteria_name }}</option>
            @endforeach 
        </select>
    </div>

    <div class="mb-3">
        <label for="description_change_name" class="form-label">Nama Deskripsi <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="description_change_name" value="{{ old('description_change_name') }}" id="description_change_name" placeholder="Masukan Deskripsi Perubahan" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Deskripsi</label>
        <select class="form-control form-select" name="is_active">
            <option value="" disabled selected hidden >Pilihan</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-add-description-change" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-add-description-change" aria-hidden="true"></span>
                <span class="btn-text">Simpan</span>
            </button>
        </div>
    </div>
</form>
