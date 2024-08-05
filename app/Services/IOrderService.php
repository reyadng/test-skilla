<?php

namespace App\Services;

use App\Exceptions\OrderAlreadyAssignedToThisWorkerException;
use App\Exceptions\OrderDeclinedException;
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\UserNotHavePartnershipException;
use App\Models\Order;

interface IOrderService
{
    /**
     * @throws UserNotHavePartnershipException
     */
    public function createOrder(
        int $userId,
        string $description,
        int $amount,
        string $date,
        string $address,
        int $typeId
    ): Order;

    /**
     * @throws OrderDeclinedException
     * @throws UserNotHavePartnershipException
     * @throws OrderNotFoundException
     * @throws OrderAlreadyAssignedToThisWorkerException
     */
    public function assignWorker(int $userId, int $orderId, int $workerId, int $amount): void;
}
