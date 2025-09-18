<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Guest',
            'email' => 'guest@example.com',
            'password' => Hash::make('guest'),
            'is_premium' => 0,
        ]);
        
        User::factory()->count(20)->create();

        User::create([
            'username' => 'Floor',
            'email' => 'floor@example.com',
            'password' => Hash::make('test'),
            'is_premium' => 1,
        ]);
    }
}
