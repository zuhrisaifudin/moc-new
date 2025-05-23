<?php

namespace App\Repositories\Criteria;

use LaravelEasyRepository\Repository;

interface CriteriaRepository extends Repository{

    public function getAll(array $filters);
    public function getCriteriaById($id);
    public function createCriteria(array $data);
    public function updateCriteria(array $data, $id);
    public function deleteCriteria($id);

     // Custom Query

     public function countTotalCriteria(): int;
     public function countTotalCriteriaByStatus(int $status): int;
     public function pluckNameWithId();
}
