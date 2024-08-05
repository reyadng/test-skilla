<?php

namespace App\Models;

use App\Repositories\Models\IWorker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Worker
 *
 * @property int $id
 * @property string $name
 * @property string $second_name
 * @property string $surname
 * @property string $phone
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Collection<int,Order> $orders
 * @property Collection<int,OrderType> $exOrderTypes
 *
 * @package App\Models
 */
class Worker extends Model implements IWorker
{
    use HasFactory;

    protected $table = 'workers';

    protected $fillable = [
        'name',
        'second_name',
        'surname',
        'phone'
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'order_workers')
            ->withPivot('amount')
            ->withTimestamps();
    }

    public function exOrderTypes(): BelongsToMany
    {
        return $this->belongsToMany(OrderType::class, 'workers_ex_order_types')
            ->withTimestamps();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSecondName(): string
    {
        return $this->second_name;
    }

    public function setSecondName(string $second_name): void
    {
        $this->second_name = $second_name;
    }

    public function getSurname(): string
    {
        return $this->surname;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function getExOrderTypes(): Collection
    {
        return $this->exOrderTypes;
    }
}
