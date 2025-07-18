<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'price',
        'buy_price',
        'subtotal',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'buy_price' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
