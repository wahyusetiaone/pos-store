<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;

class PurchaseItemSeeder extends Seeder
{
    public function run(): void
    {
        $purchases = Purchase::all();
        $products = Product::pluck('id')->toArray();
        foreach ($purchases as $purchase) {
            $itemCount = rand(1, 4);
            $usedProducts = [];
            for ($i = 0; $i < $itemCount; $i++) {
                $productId = $products[array_rand($products)];
                if (in_array($productId, $usedProducts)) continue;
                $usedProducts[] = $productId;
                $quantity = rand(1, 10);
                $price = rand(1000, 100000);
                PurchaseItem::create([
                    'purchase_id' => $purchase->id,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $quantity * $price,
                ]);
            }
        }
    }
}

