<?php

namespace App\Repositories\MocRequest;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\MocRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MocRequestRepositoryImplement extends Eloquent implements MocRequestRepository{

    protected MocRequest $model;

    public function __construct(MocRequest $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters){
        $query = $this->model->latest();

        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('moc_requests.moc_title', 'LIKE', '%'.$filters['search'].'%')
                    ->orWhere('moc_requests.moc_number', 'LIKE', '%'.$filters['search'].'%');
            });
        }

        if (!empty($filters['is_temporary']) && $filters['is_temporary'] !== 'all') {
            $query->where('moc_requests.is_temporary', (bool)$filters['is_temporary']);
        }

        return $query;
    }

    public function getMocRequestById($id){
        return $this->model->findOrFail($id);
    }

    public function createMocRequest(array $data) {
        return $this->model->create($data);
    }

    public function deleteMocRequest($id) {
        $moc = $this->model->findOrFail($id);
        return $moc->delete();
    }

    public function countTotalMocRequest(): int
    {
        return $this->model->count();
    }



}
