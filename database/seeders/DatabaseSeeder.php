<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([OrderTypeSeeder::class]);

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Order::factory()
            ->count(10)
            ->create([
                'user_id' => $user->id,
                'partnership_id' => $user->partnership_id,
            ]);

        Worker::factory()
            ->count(10)
            ->create();
    }
}
