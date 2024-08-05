<?php

namespace App\Repositories\Models;


use App\Models\OrderType;
use App\Models\Partnership;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

interface IOrder extends Arrayable
{
    public function getId(): int;

    public function setId(int $id): void;

    public function getTypeId(): int;

    public function setTypeId(int $type_id): void;

    public function getPartnershipId(): int;

    public function setPartnershipId(int $partnership_id): void;

    public function getUserId(): int;

    public function setUserId(int $user_id): void;

    public function getDescription(): string;

    public function setDescription(string $description): void;

    public function getDate(): Carbon;

    public function setDate(Carbon $date): void;

    public function getAddress(): string;

    public function setAddress(string $address): void;

    public function getAmount(): int;

    public function setAmount(int $amount): void;

    public function getStatus(): string;

    public function setStatus(string $status): void;

    public function getCreatedAt(): Carbon;

    public function setCreatedAt($created_at);

    public function getUpdatedAt(): Carbon;

    public function setUpdatedAt($updated_at);

    public function getPartnership(): Partnership;


    public function getOrderType(): OrderType;


    /**
     * @return Collection<int,IWorker>
     */
    public function getWorkers(): Collection;

}
