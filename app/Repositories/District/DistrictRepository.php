<?php

namespace App\Repositories\District;

use LaravelEasyRepository\Repository;

interface DistrictRepository extends Repository{

    // CRUD Methods
    public function getDistrictById($id);
    public function createDistrict(array $data);
    public function updateDistrict(array $data, $id);
    public function deleteDistrict($id);

     // Custom Query

     public function countTotalDistrict(): int;
     public function countTotalDistrictByStatus(int $status): int;
}
