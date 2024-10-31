<?php

namespace App\Filament\Resources\SoldProductHistoryResource\Pages;

use App\Filament\Resources\SoldProductHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoldProductHistories extends ListRecords
{
    protected static string $resource = SoldProductHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
