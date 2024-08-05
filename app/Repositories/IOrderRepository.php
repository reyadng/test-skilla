<?php

namespace App\Repositories;

use App\Enums\Status;
use App\Exceptions\ModelNotFoundException;
use App\Repositories\Models\IOrder;
use App\Repositories\Models\IWorker;
use Carbon\Carbon;

interface IOrderRepository extends HasExistenceCheck
{
    /**
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $orderId): IOrder;

    public function exists($id): bool;


    public function create(
        int $partnershipId,
        int $userId,
        string $description,
        int $amount,
        Carbon $date,
        string $address,
        int $typeId,
        Status $status,
    ): IOrder;

    public function hasWorker(int $orderId, int $workerId): bool;

    public function attachWorker(IOrder $order, IWorker $worker, int $amount): void;
}
