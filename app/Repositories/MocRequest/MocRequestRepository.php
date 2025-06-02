<?php

namespace App\Repositories\MocRequest;
use LaravelEasyRepository\Repository;
use Illuminate\Http\Request;

interface MocRequestRepository extends Repository{

    public function getAll(array $filters);
    public function getAllMyMoc(array $filters);
    public function getMocRequestById($id);
    public function createMocRequest(array $data);
    public function deleteMocRequest($id);

    // Custom Query
    public function countTotalMocRequest(): int;
}
