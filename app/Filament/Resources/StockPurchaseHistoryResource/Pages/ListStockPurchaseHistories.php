<?php

namespace App\Filament\Resources\StockPurchaseHistoryResource\Pages;

use App\Filament\Resources\StockPurchaseHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStockPurchaseHistories extends ListRecords
{
    protected static string $resource = StockPurchaseHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
