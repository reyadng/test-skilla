<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Repositories\Models\IUser;

interface IUserRepository
{
    /**
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $id): IUser;
}
