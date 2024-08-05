<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Partnership>
 */
class PartnershipFactory extends Factory
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
            'name' => $this->faker->company(),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
        ];
    }
}
