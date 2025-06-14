<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Product;

class SaleItemSeeder extends Seeder
{
    public function run(): void
    {
        $sales = Sale::all();
        $products = Product::pluck('id')->toArray();
        foreach ($sales as $sale) {
            $itemCount = rand(1, 4);
            $usedProducts = [];
            for ($i = 0; $i < $itemCount; $i++) {
                $productId = $products[array_rand($products)];
                // Avoid duplicate product in same sale
                if (in_array($productId, $usedProducts)) continue;
                $usedProducts[] = $productId;
                $quantity = rand(1, 5);
                $price = rand(1000, 100000);
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'discount' => rand(0, 1000),
                    'subtotal' => $quantity * $price,
                ]);
            }
        }
    }
}

