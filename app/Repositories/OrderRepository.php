<?php

namespace App\Repositories;

use App\Enums\Status;
use App\Exceptions\ModelNotFoundException;
use App\Models\Order;
use App\Models\OrderWorker;
use App\Repositories\Models\IOrder;
use App\Repositories\Models\IWorker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException as EloquentModelNotFoundException;

class OrderRepository implements IOrderRepository
{

    public function findOrFail(int $orderId): Order
    {
        try {
            return Order::findOrFail($orderId);
        } catch (EloquentModelNotFoundException $e) {
            throw new ModelNotFoundException('', 0, $e);
        }
    }

    public function create(
        int $partnershipId,
        int $userId,
        string $description,
        int $amount,
        Carbon $date,
        string $address,
        int $typeId,
        Status $status,
    ): Order {
        return Order::create(
            [
                'user_id' => $userId,
                'type_id' => $typeId,
                'partnership_id' => $partnershipId,
                'description' => $description,
                'amount' => $amount,
                'date' => $date,
                'address' => $address,
                'status' => $status,
            ],
        );
    }

    public function exists($id): bool
    {
        return Order::query()->where(['id' => $id])->exists();
    }

    public function hasWorker(int $orderId, int $workerId): bool
    {
        return OrderWorker::query()
            ->where(['order_id' => $orderId, 'worker_id' => $workerId])
            ->exists();
    }

    public function attachWorker(IOrder $order, IWorker $worker, int $amount): void
    {
        OrderWorker::create([
            'order_id' => $order->getId(),
            'worker_id' => $worker->getId(),
            'amount' => $amount,
        ]);
    }
}
