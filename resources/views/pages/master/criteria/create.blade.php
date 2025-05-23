<form id="form-add-criteria" action="{{ route('central-add-criteria-ajax')}}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label class="form-label">Tahap</label>
        <select name="stage_id" class="form-control form-select" id="stage_id">
            @foreach($stage as $stage_id=>$stage_name)
                <option {{$stage_id == old('$stage_id') ? 'selected' : null }} value="{{ $stage_id }}">{{ $stage_name }}</option>
            @endforeach 
        </select>
    </div>

    <div class="mb-3">
        <label for="criteria_name" class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="criteria_name" value="{{ old('criteria_name') }}" id="criteria_name" placeholder="Masukan Nama Kriteria" required>
    </div>

    

    <div class="mb-3">
        <label class="form-label">Status Kriteria</label>
        <select class="form-control form-select" name="is_active">
            <option value="" disabled selected hidden >Pilihan</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
    </div>


    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-add-criteria" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-add-criteria" aria-hidden="true"></span>
                <span class="btn-text">Simpan</span>
            </button>
        </div>
    </div>
</form>
