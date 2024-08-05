<?php

namespace App\Services;

use App\Models\Order;

interface IOrderService
{
    public function createOrder(
        int $userId,
        string $description,
        int $amount,
        string $date,
        string $address,
        int $typeId
    ): Order;
}
