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
            'name' => 'Noyori',
            'email' => 'noyori@gmail.com',
            'user_logid'=>"noyoriKyoto",
            'password'=>'test123',
            'role'=>UserRole::Coordinator
        ]);
    }
}
