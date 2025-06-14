<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Keyboard', 'description' => 'Input device for typing'],
            ['name' => 'Mouse', 'description' => 'Pointing device for computers'],
            ['name' => 'Monitor', 'description' => 'Display screen for computers'],
            ['name' => 'Printer', 'description' => 'Device for printing documents'],
        ];
        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}

