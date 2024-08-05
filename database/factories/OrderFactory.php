<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\OrderType;
use App\Models\Partnership;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = Carbon::now()->subDays(random_int(1, 365));
        $updatedAt = $createdAt->copy()->addMinutes(random_int(0, 1440));

        return [
            'partnership_id' => Partnership::factory(),
            'user_id' => User::factory(),
            'type_id' => OrderType::query()->inRandomOrder()->firstOrFail()->id,
            'description' => $this->faker->text,
            'date' => $this->faker->date,
            'address' => $this->faker->address,
            'amount' => random_int(0, 10000),
            'status' => Status::CREATED,
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
