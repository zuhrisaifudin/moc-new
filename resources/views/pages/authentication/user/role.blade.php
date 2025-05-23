<form id="form-edit-user-role" data-id="{{ $user->id }}" method="POST">
    {{ csrf_field() }}
    <table class="table table-nowrap">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Role</th>
                <th scope="col">Guard Name</th>
                <th scope="col">Jumlah Permission</th>
                <th scope="col">Pilih</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role  )
                <tr>
                    <th scope="row"><a href="#" class="fw-semibold">{{ $loop->iteration }}</a></th>
                    <td>{{ $role->display_name }}</td>
                    <td>{{ $role->guard_name }}</td>
                    <td>{{ $role->permissions->count() }}</td>
                    <td>
                        <input 
                            type="checkbox" 
                            class="form-check-input role-checkbox" 
                            data-role="{{ $role->name }}" 
                            id="role_{{ $role->id }}"
                            {{ $user->hasRole($role->name) ? 'checked' : '' }}
                        >
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</form>
