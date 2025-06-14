<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin1234'),
        ]);
        User::factory()->create([
            'name' => 'Wulan',
            'email' => 'purchase@gmail.com',
            'role' => 'purchase',
            'password' => Hash::make('admin1234'),
        ]);
        User::factory()->create([
            'name' => 'Joko',
            'email' => 'cashier@gmail.com',
            'role' => 'cashier',
            'password' => Hash::make('admin1234'),
        ]);
        User::factory()->count(9)->create();
    }
}

