<?php

namespace App\Services;

use App\Enums\Status;
use App\Exceptions\UserNotHavePartnership;
use App\Models\Order;
use App\Models\User;

class OrderService implements IOrderService
{
    /**
     * @throws UserNotHavePartnership
     */
    public function createOrder(
        int $userId,
        string $description,
        int $amount,
        string $date,
        string $address,
        int $typeId
    ): Order
    {
        $user = User::find($userId);
        if (!$user->partnership_id) {
            throw new UserNotHavePartnership();
        }

        return Order::create(
            [
                'user_id' => $userId,
                'type_id' => $typeId,
                'partnership_id' => $user->partnership_id,
                'description' => $description,
                'amount' => $amount,
                'date' => $date,
                'address' => $address,
                'status' => Status::CREATED,
            ],
        );

    }
}
