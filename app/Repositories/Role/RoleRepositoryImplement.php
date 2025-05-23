<?php

namespace App\Repositories\Role;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Role;

class RoleRepositoryImplement extends Eloquent implements RoleRepository{


    protected Role $model;

    public function __construct(Role $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters){
        $query = $this->model->where('name', '!=', 'Super Administrator')->latest()->get();
    
        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('roles.name', 'LIKE', '%'.$filters['search'].'%')
                    ->orWhere('roles.display_name', 'LIKE', '%'.$filters['search'].'%');
            });
        }

        return $query;
    }

    public function createRole(array $data){
        return $this->model->create($data);
    }

    public function getRoleById($id) {
        return $this->model->findOrFail($id);
    }

    public function updateRole(array $data, $id) {
        $role = $this->model->findOrFail($id);
        return $role->update($data);
    }

    public function deleteRole($id) {
        $role = $this->model->findOrFail($id);
        $role->revokePermissionTo($role->permissions);
        return $role->delete();
    }

    // Custom Query
    public function countTotalRole(): int
    {
        return $this->model->count();
    }
    public function countTotalRoleByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }

    public function getRoleIsActive(){
        return $this->model
        ->where('is_active', 1)
        ->where('name', '!=', 'Super Administrator')
        ->get();
    }
    
    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }
}
