<?php

namespace Database\Seeders;

use App\Models\OrderType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orderTypes = [
            ['id' => 1, 'name' => 'Погрузка/Разгрузка'],
            ['id' => 2, 'name' => 'Такелажные работы'],
            ['id' => 3, 'name' => 'Уборка'],
        ];

        DB::table((new OrderType())->getTable())
            ->insert($orderTypes);
    }
}
