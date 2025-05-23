<?php

namespace App\Repositories\Region;

use LaravelEasyRepository\Repository;

interface RegionRepository extends Repository{

     // CRUD Methods
     public function getRegionById($id);
     public function createRegion(array $data);
     public function updateRegion(array $data, $id);
     public function deleteRegion($id);
 
      // Custom Query
 
      public function countTotalRegion(): int;
      public function countTotalRegionByStatus(int $status): int;
      public function pluckNameWithId();
}
