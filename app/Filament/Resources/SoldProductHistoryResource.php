<?php

namespace App\Filament\Resources;

use App\Models\SoldProductHistory;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use App\Filament\Resources\SoldProductHistoryResource\Pages;

class SoldProductHistoryResource extends Resource
{
    protected static ?string $model = SoldProductHistory::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                // Define form schema for SoldProductHistory if needed
            ]);
    }

    // This should be a static method
    public static function canCreate(): bool
    {
        return false; // Disable the "New Product History" button
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')->label('Product Name')->sortable()->searchable(),
                TextColumn::make('quantity_sold')->sortable(),
                TextColumn::make('sale_price')->sortable(),
                TextColumn::make('sold_at')->sortable(),
            ])
            ->actions([
                // Define actions if necessary
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSoldProductHistories::route('/'),
        ];
    }
}
