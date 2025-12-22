<?php

namespace Database\Seeders;

use App\Models\Hotel as ModelsHotel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsHotel::create([
            'hotel_name' => 'Okura Osaka',
            "coor_id" =>9,
            "city"=>"大阪"
        ]);
    }
}
