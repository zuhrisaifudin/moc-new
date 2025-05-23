<form id="form-add-permission" action="{{ route('central-add-permission-ajax')}}" method="POST">
    {{ csrf_field() }}
    <div class="mb-3">
        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" placeholder="Masukan Nama Permission" readonly>
    </div>

    <div class="mb-3">
        <label for="display_name" class="form-label">Display Nama</label>
        <input type="text" class="form-control" name="display_name" value="{{ old('display_name') }}" id="display_name" placeholder="Masukan Display Nama" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea type="text" class="form-control" name="description" value="{{ old('description') }}" id="description" placeholder="Masukan Deskripsi" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Modul</label>
        <select name="module_id" class="form-control form-select" id="module_id">
            @foreach($module as $module_id=>$module_name)
                <option {{$module_id == old('$module_id') ? 'selected' : null }} value="{{ $module_id }}">{{ $module_name }}</option>
            @endforeach 
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Status Modul</label>
        <select class="form-control form-select" name="is_active">
            <option value="" disabled selected hidden >Pilihan</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
    </div>

    <div class="hstack gap-2 justify-content-end">
        <div class="mt-3 text-right">
            <button type="submit" id="btn-add-permission" class="btn btn-success w-md">
                <span class="spinner-border text-light spinner-border-sm me-1 d-none" role="status" id="spinner-add-permission" aria-hidden="true"></span>
                <span class="btn-text">Simpan</span>
            </button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const displayNameInput = document.getElementById('display_name');
        const nameInput = document.getElementById('name');

        displayNameInput.addEventListener('input', function () {
            const slug = this.value
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')       // hapus karakter non-alphanumeric
                .replace(/\s+/g, '-')            // ganti spasi jadi dash
                .replace(/-+/g, '-');            // hapus dash berlebih

            nameInput.value = slug;
        });
    });
</script>
