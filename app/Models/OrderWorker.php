<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OrderWorker
 *
 * @property int $worker_id
 * @property int $order_id
 * @property int $amount
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Order $order
 * @property Worker $worker
 *
 * @package App\Models
 */
class OrderWorker extends Model
{
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
}
