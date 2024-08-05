<?php

namespace App\Models;

use App\Enums\Status;
use App\Repositories\Models\IOrder;
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
 * @property Collection<int,Worker> $workers
 *
 * @package App\Models
 */
class Order extends Model implements IOrder
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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTypeId(): int
    {
        return $this->type_id;
    }

    public function setTypeId(int $type_id): void
    {
        $this->type_id = $type_id;
    }

    public function getPartnershipId(): int
    {
        return $this->partnership_id;
    }

    public function setPartnershipId(int $partnership_id): void
    {
        $this->partnership_id = $partnership_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getDate(): Carbon
    {
        return $this->date;
    }

    public function setDate(Carbon $date): void
    {
        $this->date = $date;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function getCreatedAt(): Carbon
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): Carbon
    {
        return $this->updated_at;
    }

    public function getPartnership(): Partnership
    {
        return $this->partnership;
    }

    public function getOrderType(): OrderType
    {
        return $this->orderType;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return Collection<int,Worker>
     */
    public function getWorkers(): Collection
    {
        return $this->workers;
    }

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
