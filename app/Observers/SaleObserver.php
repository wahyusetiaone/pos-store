<?php

namespace App\Observers;

use App\Models\Sale;
use App\Models\Finance;
use Carbon\Carbon;

class SaleObserver
{
    /**
     * Handle the Sale "created" event.
     */
    public function created(Sale $sale): void
    {
        // Get today's date without time
        $today = Carbon::parse($sale->sale_date)->startOfDay();

        // Check if there's already a daily record for this store
        $dailyFinance = Finance::where('store_id', $sale->store_id)
            ->where('type', 'income')
            ->where('category', 'daily_sale')
            ->whereDate('date', $today)
            ->first();

        $saleAmount = $sale->total - $sale->discount;

        if ($dailyFinance) {
            // Update existing record
            $dailyFinance->update([
                'amount' => $dailyFinance->amount + $saleAmount
            ]);
        } else {
            // Create new daily record
            Finance::create([
                'store_id' => $sale->store_id,
                'date' => $today,
                'type' => 'income',
                'category' => 'daily_sale',
                'amount' => $saleAmount,
                'description' => 'Rekap Penjualan Tanggal ' . $today->format('d/m/Y'),
                'user_id' => $sale->user_id
            ]);
        }

        // Create individual sale record
        Finance::create([
            'store_id' => $sale->store_id,
            'date' => $sale->sale_date,
            'type' => 'income',
            'category' => 'sale',
            'amount' => $saleAmount,
            'description' => 'Penjualan #' . $sale->id,
            'user_id' => $sale->user_id
        ]);
    }
}
