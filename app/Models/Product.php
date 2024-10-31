<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'supplier_price',
        'price',
        'quantity',
        'sold',
    ];

    public function sell(int $amount): bool
    {
        // Check if there is enough stock
        if ($this->quantity >= $amount) {
            $this->quantity -= $amount; // Update quantity
            $this->sold += $amount; // Increment sold count if applicable
            $this->save(); // Save changes to the database
            return true;
        }
        return false; // Not enough stock
    }

    public function soldHistories()
    {
        return $this->hasMany(SoldProductHistory::class);
    }
}
