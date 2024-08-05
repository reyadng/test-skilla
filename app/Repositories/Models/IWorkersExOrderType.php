<?php

namespace App\Repositories\Models;


use App\Models\OrderType;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface IWorkersExOrderType
{
    public function orderType(): BelongsTo;

    public function worker(): BelongsTo;

    public function getWorkerId(): int;

    public function getOrderTypeId(): int;

    public function getCreatedAt(): Carbon;

    public function getUpdatedAt(): Carbon;

    public function getOrderType(): IOrderType;

    public function getWorker(): IWorker;

    public function setWorkerId(int $worker_id): void;

    public function setOrderTypeId(int $order_type_id): void;

    public function setCreatedAt($created_at);

    public function setUpdatedAt($updated_at);
}
