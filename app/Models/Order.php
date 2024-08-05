<?php

namespace App\Models;

use App\Enums\Status;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Order
 *
 * @property int $id
 * @property int $type_id
 * @property int $partnership_id
 * @property int $user_id
 * @property string $description
 * @property Carbon $date
 * @property string $address
 * @property int $amount
 * @property string $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Partnership $partnership
 * @property OrderType $orderType
 * @property User $user
 * @property Collection|Worker[] $workers
 *
 * @package App\Models
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $casts = [
        'type_id' => 'int',
        'partnership_id' => 'int',
        'user_id' => 'int',
        'date' => 'datetime',
        'amount' => 'int',
        'status' => Status::class,
    ];

    protected $fillable = [
        'type_id',
        'partnership_id',
        'user_id',
        'description',
        'date',
        'address',
        'amount',
        'status'
    ];

    public function partnership(): BelongsTo
    {
        return $this->belongsTo(Partnership::class);
    }

    public function orderType(): BelongsTo
    {
        return $this->belongsTo(OrderType::class, 'type_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function workers(): BelongsToMany
    {
        return $this->belongsToMany(Worker::class, 'order_workers')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
