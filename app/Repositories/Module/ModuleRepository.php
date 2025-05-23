<?php

namespace App\Repositories\Module;

use LaravelEasyRepository\Repository;

interface ModuleRepository extends Repository{

    public function getAll(array $filters);
    public function getModuleById($id);
    public function updateModule(array $data , $id);
    
    // Custom Query
    public function pluckNameWithId();
    public function countTotalModule(): int;
    public function countTotalModuleByStatus($status): int;
    public function getAllWithPermissions();


}
