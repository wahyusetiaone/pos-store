<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Banner extends Model
{
    protected $fillable = [
        'store_id',
        'path',
    ];
    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
