<?php

namespace App\Filament\Resources;

use App\Models\StockPurchaseHistory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\StockPurchaseHistoryResource\Pages;


class StockPurchaseHistoryResource extends Resource
{
    protected static ?string $model = StockPurchaseHistory::class;
    protected static ?string $navigationIcon = 'heroicon-o-document';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            // Define fields as necessary, for example:
            TextColumn::make('product.name')->label('Product Name'),
            TextColumn::make('quantity'),
            TextColumn::make('price'),
            TextColumn::make('supplier_price'),
            TextColumn::make('purchased_at'),
        ]);
    }
    public static function canCreate(): bool
    {
        return false; // Disable the "New Product History" button
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')->label('Product Name')->sortable()->searchable(),
                TextColumn::make('quantity')->sortable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('supplier_price')->sortable(),
                TextColumn::make('purchased_at')->sortable(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStockPurchaseHistories::route('/'),
        ];
    }
}
