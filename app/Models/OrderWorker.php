<?php

namespace App\Models;

use App\Repositories\Models\IOrderWorker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OrderWorker
 *
 * @property int $worker_id
 * @property int $order_id
 * @property int $amount
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Order $order
 * @property Worker $worker
 *
 * @package App\Models
 */
class OrderWorker extends Model implements IOrderWorker
{
    use HasTimestamps;

    protected $table = 'order_workers';
    public $incrementing = false;

    protected $casts = [
        'worker_id' => 'int',
        'order_id' => 'int',
        'amount' => 'int'
    ];

    protected $fillable = [
        'worker_id',
        'order_id',
        'amount'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

    public function getWorkerId(): int
    {
        return $this->worker_id;
    }

    public function setWorkerId(int $worker_id): void
    {
        $this->worker_id = $worker_id;
    }

    public function getOrderId(): int
    {
        return $this->order_id;
    }

    public function setOrderId(int $order_id): void
    {
        $this->order_id = $order_id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function getWorker(): Worker
    {
        return $this->worker;
    }
}
