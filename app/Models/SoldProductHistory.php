<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoldProductHistory extends Model
{
    protected $fillable = ['product_id', 'quantity_sold', 'sale_price', 'sold_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
}
