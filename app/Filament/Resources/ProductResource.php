<?php

namespace App\Filament\Resources;

use App\Models\Product;
use App\Models\StockPurchase;
use App\Models\SoldProductHistory;
use App\Models\StockPurchaseHistory; // Import the StockPurchaseHistory model
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\SoldHistoriesRelationManager;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('description'),
                TextInput::make('price')->numeric()->required(),
                TextInput::make('supplier_price')->numeric()->required(),
                TextInput::make('quantity')->numeric()->default(0)->required(),
                TextInput::make('sold')->numeric()->default(0)->disabled(),
            ]);
    }

    public static function create(array $data): Product
    {
        // Create the Product first
        $product = Product::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'supplier_price' => $data['supplier_price'],
            'quantity' => $data['quantity'],
            'sold' => $data['sold'],
        ]);

        // Create StockPurchaseHistory entry
        StockPurchaseHistory::create([
            'product_id' => $product->id,
            'quantity' => $data['quantity'],
            'price' => $data['price'],
            'supplier_price' => $data['supplier_price'],
            'purchased_at' => now(), // Ensure this matches your field in the database
        ]);


        return $product;
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('supplier_price')->sortable(),
                TextColumn::make('price')->sortable(),
                TextColumn::make('quantity')->sortable(),
                TextColumn::make('sold')->sortable(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('View/Edit')
                    ->icon('heroicon-o-eye')
                    ->url(fn (Product $record) => route('filament.admin.resources.products.edit', $record))
                    ->color('warning'),
                Action::make('sell')
                    ->label('Sell Product')
                    ->icon('heroicon-o-shopping-cart')
                    ->color('success')
                    ->form([
                        TextInput::make('amount')->label('Amount to Sell')->numeric()->required(),
                    ])
                    ->action(function (Product $record, array $data) {
                        if ($record->sell($data['amount'])) {
                            SoldProductHistory::create([
                                'product_id' => $record->id,
                                'quantity_sold' => $data['amount'],
                                'sale_price' => $record->price,
                                'sold_at' => now(),
                            ]);

                            return redirect()->route('filament.admin.resources.products.index')
                                ->with('toast', ['type' => 'success', 'message' => 'Product sold successfully!']);
                        } else {
                            return redirect()->route('filament.admin.resources.products.index')
                                ->with('toast', ['type' => 'error', 'message' => 'Not enough stock!']);
                        }
                    }),
            ])
            ->headerActions([
                Action::make('previewReport')
                    ->label('Preview Report')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->url(route('report.preview'))
                    ->openUrlInNewTab(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            SoldHistoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
