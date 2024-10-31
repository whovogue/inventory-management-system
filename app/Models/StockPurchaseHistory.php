<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockPurchaseHistory extends Model
{
    // Specify the table name if it differs from the default
    protected $table = 'stock_purchase_histories'; // Adjust if your table name is different

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'supplier_price',
        'purchased_at', // Change this to match the migration
    ];
    

    // Define the relationship to the Product model
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
