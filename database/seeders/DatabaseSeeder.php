<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\WorkersExOrderType;
use Laravel\Passport\Client;

use App\Models\Worker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $client = Client::create([
            'name' => 'Password API client',
            'secret' => '$2y$10$yVeFoX3BCEiw8HJ0hYWf5eBaQ5evTpOp94d8qBUxCywdHkJq4OsU2',
            'password_client' => true,
            'personal_access_client' => false,
            'revoked' => false,
            'redirect' => 'http://localhost',
        ]);

        $this->command->info('Passport client created successfully!');
        $this->command->info('Client ID: ' . $client->id);
        $this->command->info('Client Secret: ' . $client->secret);

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

        WorkersExOrderType::create([
            'worker_id' => 1,
            'order_type_id' => 1
        ]);
        WorkersExOrderType::create([
            'worker_id' => 3,
            'order_type_id' => 1
        ]);
        WorkersExOrderType::create([
            'worker_id' => 3,
            'order_type_id' => 3
        ]);
    }
}
