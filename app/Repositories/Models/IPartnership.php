<?php

namespace App\Repositories\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface IPartnership
{
    public function orders(): HasMany;

    public function users(): HasMany;

    public function getId(): int;

    public function getName(): string;

    public function getCreatedAt(): Carbon;

    public function getUpdatedAt(): Carbon;

    /**
     * @return Collection<int,IOrder>
     */
    public function getOrders(): Collection;

    /**
     * @return Collection<int,IUser>
     */
    public function getUsers(): Collection;

    public function setId(int $id): void;

    public function setName(string $name): void;

    public function setCreatedAt($created_at);

    public function setUpdatedAt($updated_at);
}
