<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository{

   
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll(array $filters){
        $query = $this->model->latest();

        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('users.name', 'LIKE', '%'.$filters['search'].'%')
                    ->orWhere('users.email', 'LIKE', '%'.$filters['search'].'%');
            });
        }

        return $query;
    }

    public function getUserById($id){
        return $this->model->findOrFail($id);
    }

    public function updateUser(array $data, $id) {
        $user = $this->model->findOrFail($id);
        return $user->update($data);
    }

    public function deleteUser($id){
        $user = User::findOrFail($id);
        
        $user->roles->each(function($role) use ($user) {
            $user->removeRole($role);
        });
        
        return $user->delete();
    }

    // Custom Query

    public function countTotalUser(): int
    {
        return $this->model->count();
    }
    public function countTotalUserByStatus($status): int {
        return $this->model->where('is_active', $status)->count();
    }

    public function countSoftDeletedUsers(): int{
        return $this->model->onlyTrashed()->count();
    }

    public function getActiveUsers(){
        return $this->model
        ->select('id', 'name', 'position')
        ->where('is_active', 1)
        ->get();
    }
}
