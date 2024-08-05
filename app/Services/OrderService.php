<?php

namespace App\Services;

use App\Enums\Status;
use App\Exceptions\OrderAlreadyAssignedToThisWorkerException;
use App\Exceptions\OrderDeclinedException;
use App\Exceptions\OrderNotFoundException;
use App\Exceptions\UserNotHavePartnershipException;
use App\Models\Order;
use App\Models\OrderWorker;
use App\Models\User;
use App\Models\Worker;
use Laravel\Passport\Passport;

class OrderService implements IOrderService
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
    ): Order {
        $user = $this->getUser($userId);

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

    public function assignWorker(int $userId, int $orderId, int $workerId, int $amount): void
    {
        $user = $this->getUser($userId);
        /** @var Order $order */
        $order = Order::findOrFail($orderId);

        if ($order->partnership_id !== $user->partnership_id) {
            throw new OrderNotFoundException();
        }

        /** @var Worker $worker */
        $worker = Worker::findOrFail($workerId);
        $isAlreadyAssigned = OrderWorker::query()->where(['order_id' => $orderId, 'worker_id' => $workerId])->exists();

        if ($isAlreadyAssigned) {
            throw new OrderAlreadyAssignedToThisWorkerException();
        }

        $isTypeExcluded = $worker
            ->exOrderTypes()
            ->where(['order_type_id' => $order->type_id])
            ->exists();

        if ($isTypeExcluded) {
            throw new OrderDeclinedException();
        }

        $order->workers()->attach($worker, ['amount' => $amount]);

    }

    /**
     * @throws UserNotHavePartnershipException
     */
    public function getUser(int $userId): User
    {
        $user = User::find($userId);
        if (!$user->partnership_id) {
            throw new UserNotHavePartnershipException();
        }

        return $user;
    }
}
