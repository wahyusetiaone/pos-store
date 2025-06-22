<?php

namespace App\Observers;

use App\Models\Sale;
use App\Models\Finance;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     */
    public function created(Sale $sale): void
    {
        // Create finance record for the sale
        Finance::create([
            'store_id' => $sale->store_id,
            'date' => $sale->sale_date,
            'type' => 'income',
            'category' => 'sale',
            'amount' => $sale->total - $sale->discount,
            'description' => 'Penjualan #' . $sale->id,
            'user_id' => $sale->user_id
        ]);
    }
}
