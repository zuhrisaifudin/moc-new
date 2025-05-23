<?php

namespace App\Repositories\Permission;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Permission;

class PermissionRepositoryImplement extends Eloquent implements PermissionRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected Permission $model;

    public function __construct(Permission $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters){
        $query = $this->model->latest()->with('module');
    
        if (!empty($filters['search'])) {
            $search = $filters['search'];
    
            $query->where(function($q) use ($search) {
                $q->where('permissions.name', 'LIKE', "%{$search}%")
                  ->orWhere('permissions.display_name', 'LIKE', "%{$search}%")
                  ->orWhere('permissions.description', 'LIKE', "%{$search}%");
            })->orWhereHas('module', function($q) use ($search) {
                $q->where('modules.name', 'LIKE', "%{$search}%")
                  ->orWhere('modules.description', 'LIKE', "%{$search}%");
            });
        }

        if (!empty($filters['module']) && $filters['module'] !== 'all') {
            $query->where('permissions.module_id', $filters['module']); 
        }
    
        return $query;
    }

    public function getPermissionById($id) {
        return $this->model->findOrFail($id);
    }

    public function createPermission(array $data) {
        return $this->model->create($data);
    }

    public function updatePermission(array $data, $id) {
        $permission = $this->model->findOrFail($id);
        return $permission->update($data);
    }

    public function deletePermission($id) {
        $permission = $this->model->findOrFail($id);
        return $permission->delete();
    }


    // Custom Query

    public function pluckNameWithId() {
        return $this->model->pluck('name', 'id');
    }

    public function countTotalPermission(): int {
        return $this->model->count();
    }

    public function countTotalPermissionByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }

    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }

}
