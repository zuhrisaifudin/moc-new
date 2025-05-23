<ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link active" data-bs-toggle="tab" href="#home1" role="tab" aria-selected="false" tabindex="-1">
            Detail Modul
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" data-bs-toggle="tab" href="#profile1" role="tab" aria-selected="false" tabindex="-1">
            Permission
        </a>
    </li>
    
</ul>

<!-- Tab panes -->
<div class="tab-content text-muted">
    <div class="tab-pane active" id="home1" role="tabpanel">
        <div class="d-flex">
        
            <div class="flex-grow-1 ms-2">
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
                </form>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="profile1" role="tabpanel">
        <div class="d-flex">
            
            <div class="flex-grow-1 ms-2">
                <table class="table table-nowrap">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nama Permission</th>
                            <th scope="col">Display Nama</th>
                            <th scope="col">Guard Name</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission )
                        <tr>
                            <th scope="row"><a href="#" class="fw-semibold">{{ $permission->id }}</a></th>
                            <td>{{ $permission->name ?? '' }}</td>
                            <td>{{ $permission->display_name ?? '' }}</td>
                            <td>{{ $permission->guard_name ?? '' }}</td>
                            
                        </tr> 
                        @endforeach   
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</div>