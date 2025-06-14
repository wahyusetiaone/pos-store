<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class,
            ProductImageSeeder::class,
            UserSeeder::class,
            SaleSeeder::class,
            SaleItemSeeder::class,
            PurchaseSeeder::class,
            PurchaseItemSeeder::class,
            FinanceSeeder::class,
        ]);
    }
}
