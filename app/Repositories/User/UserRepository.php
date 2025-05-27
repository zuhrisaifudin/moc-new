<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository{

    public function getAll(array $filters);
    public function getUserById($id);
    public function updateUser(array $data, $id);
    public function deleteUser($id);
    

    // Custom Queries
    public function getActiveUsers();
    public function countTotalUser(): int;
    public function countTotalUserByStatus(int $status): int;
    public function countSoftDeletedUsers(): int;
}
