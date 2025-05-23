<?php

namespace App\Repositories\DescriptionChange;

use LaravelEasyRepository\Repository;

interface DescriptionChangeRepository extends Repository{
    // CRUD Methods
    public function getDescriptionChangeById($id);
    public function createDescriptionChange(array $data);
    public function updateDescriptionChange(array $data, $id);
    public function deleteDescriptionChange($id);

     // Custom Query

     public function countTotalDescriptionChange(): int;
     public function countTotalDescriptionChangeByStatus(int $status): int;
}
