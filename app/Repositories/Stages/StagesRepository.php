<?php

namespace App\Repositories\Stages;

use LaravelEasyRepository\Repository;

interface StagesRepository extends Repository{

    public function getAll(array $filters);
    public function getStagesById($id);
    public function createStages(array $data);
    public function updateStages(array $data, $id);
    public function deleteStages($id);

     // Custom Query

     public function countTotalStages(): int;
     public function countTotalStagesByStatus(int $status): int;
     public function pluckNameWithId();
}
