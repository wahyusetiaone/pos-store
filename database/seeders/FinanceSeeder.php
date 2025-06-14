<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Finance;
use App\Models\User;
use Illuminate\Support\Carbon;

class FinanceSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        $types = ['income', 'expense'];
        $categories = ['Sales', 'Purchase', 'Salary', 'Other'];
        for ($i = 0; $i < 30; $i++) {
            Finance::create([
                'date' => Carbon::now()->subDays(rand(0, 30)),
                'type' => $types[array_rand($types)],
                'category' => $categories[array_rand($categories)],
                'amount' => rand(10000, 200000),
                'description' => 'Test ' . $types[array_rand($types)],
                'user_id' => $users[array_rand($users)],
            ]);
        }
    }
}

