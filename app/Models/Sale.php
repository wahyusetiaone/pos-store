<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'store_id', // dari migration alter table
        'customer_id',
        'user_id',
        'sale_date',
        'total',
        'discount',
        'paid',
        'payment_method',
        'order_type',
        'note'
    ];

    protected $casts = [
        'sale_date' => 'datetime',
        'total' => 'decimal:2',
        'discount' => 'decimal:2',
        'paid' => 'decimal:2'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
