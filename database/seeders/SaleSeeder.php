<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Carbon;

class SaleSeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::pluck('id')->toArray();
        $users = User::pluck('id')->toArray();
        for ($i = 0; $i < 40; $i++) {
            Sale::create([
                'customer_id' => $customers[array_rand($customers)],
                'user_id' => $users[array_rand($users)],
                'sale_date' => Carbon::now()->subDays(rand(0, 30)),
                'total' => rand(10000, 500000),
                'discount' => rand(0, 5000),
                'paid' => rand(10000, 500000),
                'payment_method' => 'cash',
                'note' => 'Test sale',
            ]);
        }
    }
}

