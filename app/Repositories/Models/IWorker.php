<?php

namespace App\Repositories\Models;


use Carbon\Carbon;
use Illuminate\Support\Collection;

interface IWorker
{
    public function getId(): int;

    public function setId(int $id): void;

    public function getName(): string;

    public function setName(string $name): void;

    public function getSecondName(): string;

    public function setSecondName(string $second_name): void;

    public function getSurname(): string;

    public function setSurname(string $surname): void;

    public function getPhone(): string;

    public function setPhone(string $phone): void;

    public function getCreatedAt(): Carbon;

    public function getUpdatedAt(): Carbon;

    /**
     * @return Collection<int,IOrder>
     */
    public function getOrders(): Collection;

    public function getExOrderTypes(): Collection;
}
