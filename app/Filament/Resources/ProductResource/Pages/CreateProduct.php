<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\StockPurchaseHistory;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function afterCreate(): void
    {
        StockPurchaseHistory::create([
            'product_id' => $this->record->id,
            'quantity' => $this->record->quantity,
            'price' => $this->record->price,
            'supplier_price' => $this->record->supplier_price,
            'purchase_at' => now(), // Ensure the field name matches your database column
        ]);
    }
}
