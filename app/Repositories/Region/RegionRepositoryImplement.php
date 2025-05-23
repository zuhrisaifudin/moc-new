<?php

namespace App\Repositories\Region;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Region;

class RegionRepositoryImplement extends Eloquent implements RegionRepository{

    protected Region $model;

    public function __construct(Region $model)
    {
        $this->model = $model;
    }

   
    public function getRegionById($id) {
        return $this->model->findOrFail($id);
    }

    public function createRegion(array $data) {
        return $this->model->create($data);
    }

    public function updateRegion(array $data, $id) {
        $stages = $this->model->findOrFail($id);
        return $stages->update($data);
    }

    public function deleteRegion($id) {
        $stages = $this->model->findOrFail($id);
        return $stages->delete();
    }


    // Custom Query


    public function countTotalRegion(): int {
        return $this->model->count();
    }

    public function countTotalRegionByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }

    public function pluckNameWithId() {
        return $this->model->pluck('name', 'id');
    }
}
