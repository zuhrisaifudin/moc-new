<?php

namespace App\Repositories\Module;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Module;

class ModuleRepositoryImplement extends Eloquent implements ModuleRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected Module $model;

    public function __construct(Module $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters){
        $query = $this->model->latest();

        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('modules.name', 'LIKE', '%'.$filters['search'].'%')
                    ->orWhere('modules.description', 'LIKE', '%'.$filters['search'].'%');
            });
        }

        return $query;
    }  
    public function getModuleById($id) {
        return $this->model->findOrFail($id);
    }

    public function updateModule(array $data, $id) {
        $module = $this->getModuleById($id);
        if (!$module->update($data)) {
            throw new \Exception("Gagal mengupdate modul");
        }
        return $module;
    }

    // Custom Query
    public function pluckNameWithId() {
        return $this->model->pluck('name', 'id');
    }
    public function countTotalModule(): int {
        return $this->model->count();
    }
    public function countTotalModuleByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }

    public function getAllWithPermissions()
    {
        return $this->model->with('permissions')->get();
    }   


}
