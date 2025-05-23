<?php

namespace App\Repositories\Permission;

use LaravelEasyRepository\Repository;

interface PermissionRepository extends Repository{

    public function getAll(array $filters);
    public function getPermissionById($id);
    public function createPermission(array $data);
    public function updatePermission(array $data, $id);
    public function deletePermission($id);

    // Custom Query
    public function pluckNameWithId();
    public function countTotalPermission(): int;
    public function countTotalPermissionByStatus(int $status): int;
    public function findByName(string $name);

 
}
