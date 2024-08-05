<?php

namespace App\Repositories\Models;


use Illuminate\Database\Eloquent\Collection;

interface IOrderType
{
    public function getId(): int;

    public function setId(int $id): void;

    public function getName(): string;

    public function setName(string $name): void;

    /**
     * @return Collection<int,IOrder>
     */
    public function getOrders(): Collection;

    /**
     * @return Collection<int, IWorker>
     */
    public function getWorkers(): Collection;
}
