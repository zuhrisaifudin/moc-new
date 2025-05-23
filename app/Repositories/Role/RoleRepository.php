<?php

namespace App\Repositories\Role;

use LaravelEasyRepository\Repository;

interface RoleRepository extends Repository{

    public function getAll(array $filters);
    public function createRole(array $data);
    public function getRoleById($id);
    public function updateRole(array $data, $id);
    public function deleteRole($id);
    

    // Custom methods
    public function countTotalRole(): int;
    public function countTotalRoleByStatus(int $status): int;
    public function getRoleIsActive();
    public function findByName(string $name);
   
    
}
