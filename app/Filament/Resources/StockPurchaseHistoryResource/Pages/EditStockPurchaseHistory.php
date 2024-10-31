<?php

namespace App\Filament\Resources\StockPurchaseHistoryResource\Pages;

use App\Filament\Resources\StockPurchaseHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStockPurchaseHistory extends EditRecord
{
    protected static string $resource = StockPurchaseHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
