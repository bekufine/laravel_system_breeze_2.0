<?php

namespace Database\Seeders;

use App\Models\Hotel;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Order::class()->create([
            'hotel_id' => 5,
            "coor_id"=>9,
            "dep_id"=>4,
            "city"=>"大阪"
        ]);
    }
}
