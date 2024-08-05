<?php

namespace App\Models;

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
class WorkersExOrderType extends Model
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
}
