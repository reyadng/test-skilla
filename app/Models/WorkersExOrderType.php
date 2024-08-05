<?php

namespace App\Models;

use App\Repositories\Models\IWorkersExOrderType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class WorkersExOrderType
 *
 * @property int $worker_id
 * @property int $order_type_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property OrderType $orderType
 * @property Worker $worker
 *
 * @package App\Models
 */
class WorkersExOrderType extends Model implements IWorkersExOrderType
{
    protected $table = 'workers_ex_order_types';
    public $incrementing = false;

    protected $casts = [
        'worker_id' => 'int',
        'order_type_id' => 'int'
    ];

    protected $fillable = [
        'worker_id',
        'order_type_id'
    ];

    public function orderType():BelongsTo
    {
        return $this->belongsTo(OrderType::class);
    }

    public function worker():BelongsTo
    {
        return $this->belongsTo(Worker::class);
    }

    public function getWorkerId(): int
    {
        return $this->worker_id;
    }

    public function getOrderTypeId(): int
    {
        return $this->order_type_id;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function getOrderType(): OrderType
    {
        return $this->orderType;
    }

    public function getWorker(): Worker
    {
        return $this->worker;
    }

    public function setWorkerId(int $worker_id): void
    {
        $this->worker_id = $worker_id;
    }

    public function setOrderTypeId(int $order_type_id): void
    {
        $this->order_type_id = $order_type_id;
    }
}
