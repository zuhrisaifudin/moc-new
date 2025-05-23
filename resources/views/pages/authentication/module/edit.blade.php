<form id="form-edit-module" action="{{ route('central-edit-module-ajax', Crypt::encryptString($module->id)) }}" method="POST">
    {{ csrf_field() }}

    <div class="mb-3">
        <label for="name" class="form-label">Nama</label>
        <input type="text" class="form-control" name="name" value="{{ $module->name }}" id="name"  required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi Modul <span class="text-danger">*</span></label>
        <textarea type="text" class="form-control" name="description" placeholder="Masukan Deskripsi Modul"> {{ $module->description }}</textarea>
    </div>


    <div class="mb-3">
        <label class="form-label">Core</label>
        <select class="form-control form-select" name="core">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $module->core == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{$module->core == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Modul</label>
        <select class="form-control form-select" name="is_active">
            <option value="" selected hidden >Pilihan</option>
            <option value="1" {{ $module->is_active == "1" ? 'selected' : null }}>Aktif</option>
            <option value="0" {{$module->is_active == "0" ? 'selected' : null }}>Tidak Aktif</option>
        </select>
    </div>

    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-edit-module" class="btn btn-success w-md">Ubah</button>
        </div>
    </div>
</form>
