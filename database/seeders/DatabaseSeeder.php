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
        $secret = 'SsvwFqk2lEDzdlfshuvFImQJO72b9dSxlcZLmpBQ';
        $client = Client::create([
            'id' => '9cb428e3-7a70-4c67-99ad-a5a40d543111',
            'name' => 'Password API client',
            'secret' => '' . $secret . '',
            'password_client' => true,
            'personal_access_client' => false,
            'revoked' => false,
            'redirect' => 'http://localhost',
        ]);

        $this->command->info('Passport client created successfully!');
        $this->command->info('Client ID: ' . $client->id);
        $this->command->info('Client Name: ' . $client->name);
        $this->command->info('Client Secret: ' . $secret);

        $client = Client::create([
            'id' => '9cb428e3-9b0d-449f-968d-9568e7d271c2',
            'name' => 'Regular API client',
            'secret' => '' . $secret . '',
            'password_client' => false,
            'personal_access_client' => false,
            'revoked' => false,
            'redirect' => 'http://localhost',
        ]);

        $this->command->info('Passport client created successfully!');
        $this->command->info('Client ID: ' . $client->id);
        $this->command->info('Client Name: ' . $client->name);
        $this->command->info('Client Secret: ' . $secret);

        $client = Client::create([
            'id' => '9cb428e3-bd5f-4f77-851c-7976ce8b42af',
            'name' => 'Personal API client',
            'secret' => '' . $secret . '',
            'password_client' => false,
            'personal_access_client' => true,
            'revoked' => false,
            'redirect' => 'http://localhost',
        ]);

        $this->command->info('Passport client created successfully!');
        $this->command->info('Client ID: ' . $client->id);
        $this->command->info('Client Name: ' . $client->name);
        $this->command->info('Client Secret: ' . $secret);


        $this->call([OrderTypeSeeder::class]);
        $this->command->info('Order types created');

        /** @var User $user */
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->command->info('User created');

        Order::factory()
            ->count(10)
            ->create([
                'user_id' => $user->id,
                'partnership_id' => $user->partnership_id,
            ]);
        $this->command->info('Orders created');

        Worker::factory()
            ->count(10)
            ->create();
        $this->command->info('Workers created');

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
        $this->command->info('Type 1 excluded for worker_id=1. Types 1 and 3 excluded for worker_id=3');
    }
}
