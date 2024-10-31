<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'supplier_price',
    ];

    // If you want to add relationships, you can do so here
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

