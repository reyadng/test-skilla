<?php

namespace App\Repositories\Models;


use Carbon\Carbon;

interface IOrderWorker
{
    public function getWorkerId(): int;

    public function setWorkerId(int $worker_id): void;

    public function getOrderId(): int;

    public function setOrderId(int $order_id): void;

    public function getAmount(): int;

    public function setAmount(int $amount): void;

    public function getCreatedAt(): ?Carbon;

    public function setCreatedAt($value);

    public function getUpdatedAt(): ?Carbon;

    public function setUpdatedAt($value);

    public function getOrder(): IOrder;

    public function getWorker(): IWorker;
}
