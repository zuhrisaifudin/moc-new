<?php

namespace App\Repositories\District;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\District;

class DistrictRepositoryImplement extends Eloquent implements DistrictRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected District $model;

    public function __construct(District $model)
    {
        $this->model = $model;
    }

    
    public function getDistrictById($id) {
        return $this->model->findOrFail($id);
    }

    public function createDistrict(array $data) {
        return $this->model->create($data);
    }

    public function updateDistrict(array $data, $id) {
        $stages = $this->model->findOrFail($id);
        return $stages->update($data);
    }

    public function deleteDistrict($id) {
        $stages = $this->model->findOrFail($id);
        return $stages->delete();
    }


    // Custom Query


    public function countTotalDistrict(): int {
        return $this->model->count();
    }

    public function countTotalDistrictByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }

    
}
