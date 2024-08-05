<?php

namespace App\Repositories;

use App\Exceptions\ModelNotFoundException;
use App\Repositories\Models\IWorker;
use Illuminate\Support\Collection;

interface IWorkerRepository extends HasExistenceCheck
{
    /**
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $id): IWorker;

    /**
     * @param array $orderTypeIds
     * @param int $start
     * @param int $limit
     * @return Collection<int,IWorker>
     */
    public function filterByOrderType(array $orderTypeIds, int $start, int $limit): Collection;

    public function hasExcludedType(int $workerId, int $orderTypeId): bool;
}
