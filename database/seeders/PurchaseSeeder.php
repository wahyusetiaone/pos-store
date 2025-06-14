<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Support\Carbon;

class PurchaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('id')->toArray();
        for ($i = 0; $i < 20; $i++) {
            Purchase::create([
                'user_id' => $users[array_rand($users)],
                'purchase_date' => Carbon::now()->subDays(rand(0, 30)),
                'supplier' => 'Supplier ' . rand(1, 10),
                'total' => rand(10000, 300000),
                'note' => 'Test purchase',
            ]);
        }
    }
}

