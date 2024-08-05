<?php

namespace App\Services;

use App\Models\Worker;
use Illuminate\Support\Collection;

interface IWorkerService
{
    /**
     * @param array $orderTypeIds
     * @return Worker[]|Collection
     */
    public function filterByOrderType(array $orderTypeIds);
}
