<?php

namespace App\Repositories\DescriptionChange;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\DescriptionChange;

class DescriptionChangeRepositoryImplement extends Eloquent implements DescriptionChangeRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected DescriptionChange $model;

    public function __construct(DescriptionChange $model)
    {
        $this->model = $model;
    }
    

    public function getDescriptionChangeById($id) {
        return $this->model->findOrFail($id);
    }

    public function createDescriptionChange(array $data) {
        return $this->model->create($data);
    }

    public function updateDescriptionChange(array $data, $id) {
        $stages = $this->model->findOrFail($id);
        return $stages->update($data);
    }

    public function deleteDescriptionChange($id) {
        $stages = $this->model->findOrFail($id);
        return $stages->delete();
    }


    // Custom Query


    public function countTotalDescriptionChange(): int {
        return $this->model->count();
    }

    public function countTotalDescriptionChangeByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }
}
