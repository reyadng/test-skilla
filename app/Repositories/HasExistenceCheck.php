<?php

namespace App\Repositories;

interface HasExistenceCheck
{
    public function exists($id): bool;
}
