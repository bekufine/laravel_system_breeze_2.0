<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoordinatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Chin',
            'email' => 'chin@gmail.com',
            'user_logid'=>"ChinOsaka",
            'password'=>'test123',
            "city"=>"大阪",
            'role'=>UserRole::Coordinator
        ]);
    }
}
