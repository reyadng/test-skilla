<?php

namespace App\Models;

use App\Repositories\Models\IOrderType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class OrderType
 *
 * @property int $id
 * @property string $name
 *
 * @property Collection<int,Order> $orders
 * @property Collection<int,Worker> $workers
 *
 * @package App\Models
 */
class OrderType extends Model implements IOrderType
{
    protected $table = 'order_types';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'type_id');
    }

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class, 'workers_ex_order_types')
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

    /**
     * @return Collection<int,Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    /**
     * @return Collection<int, Worker>
     */
    public function getWorkers(): Collection
    {
        return $this->workers;
    }
}
