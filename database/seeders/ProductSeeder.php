<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id')->toArray();
        Product::factory()->count(30)->create([
            'category_id' => function () use ($categories) {
                return $categories[array_rand($categories)];
            },
        ]);
    }
}

