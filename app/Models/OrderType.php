<?php

namespace App\Models;

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
 * @property Collection|Order[] $orders
 * @property Collection|Worker[] $workers
 *
 * @package App\Models
 */
class OrderType extends Model
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
}
