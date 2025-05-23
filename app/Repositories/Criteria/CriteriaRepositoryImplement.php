<?php

namespace App\Repositories\Criteria;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Criteria;

class CriteriaRepositoryImplement extends Eloquent implements CriteriaRepository{
    
    protected Criteria $model;

    public function __construct(Criteria $model)
    {
        $this->model = $model;
    }

    
    public function getAll(array $filters)
    {
        $query = $this->model->latest();
    }
    

    public function getCriteriaById($id) {
        return $this->model->findOrFail($id);
    }

    public function createCriteria(array $data) {
        return $this->model->create($data);
    }

    public function updateCriteria(array $data, $id) {
        $stages = $this->model->findOrFail($id);
        return $stages->update($data);
    }

    public function deleteCriteria($id) {
        $stages = $this->model->findOrFail($id);
        return $stages->delete();
    }


    // Custom Query


    public function countTotalCriteria(): int {
        return $this->model->count();
    }

    public function countTotalCriteriaByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }

    public function pluckNameWithId() {
        return $this->model->pluck('criteria_name', 'id');
    }
}
