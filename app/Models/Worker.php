<?php

namespace App\Models;

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
 * @property Collection|Order[] $orders
 * @property Collection|OrderType[] $exOrderTypes
 *
 * @package App\Models
 */
class Worker extends Model
{
    use HasFactory;

	protected $table = 'workers';

	protected $fillable = [
		'name',
		'second_name',
		'surname',
		'phone'
	];

	public function orders():BelongsToMany
	{
		return $this->belongsToMany(Order::class, 'order_workers')
					->withPivot('amount')
					->withTimestamps();
	}

	public function exOrderTypes():BelongsToMany
	{
		return $this->belongsToMany(OrderType::class, 'workers_ex_order_types')
					->withTimestamps();
	}
}
