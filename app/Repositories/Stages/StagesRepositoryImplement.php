<?php

namespace App\Repositories\Stages;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Stage;

class StagesRepositoryImplement extends Eloquent implements StagesRepository{

    protected Stage $model;

    public function __construct(Stage $model)
    {
        $this->model = $model;
    }

  
    public function getAll(array $filters)
    {
        $query = $this->model->latest();
    }
    

    public function getStagesById($id) {
        return $this->model->findOrFail($id);
    }

    public function createStages(array $data) {
        return $this->model->create($data);
    }

    public function updateStages(array $data, $id) {
        $stages = $this->model->findOrFail($id);
        return $stages->update($data);
    }

    public function deleteStages($id) {
        $stages = $this->model->findOrFail($id);
        return $stages->delete();
    }


    // Custom Query


    public function countTotalStages(): int {
        return $this->model->count();
    }

    public function countTotalStagesByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }

    public function pluckNameWithId() {
        return $this->model->pluck('stages_name', 'id');
    }
}
