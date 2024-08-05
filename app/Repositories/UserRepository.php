<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException as EloquentModelNotFoundException;

class UserRepository implements IUserRepository
{
    public function findOrFail(int $id): User
    {
        try {
            return User::findOrFail($id);
        } catch (EloquentModelNotFoundException $e) {
            throw new ModelNotFoundException('', 0, $e);
        }
    }
}
