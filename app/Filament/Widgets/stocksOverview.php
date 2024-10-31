<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\SoldProductHistory;
use App\Models\StockPurchaseHistory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class stocksOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Total Available Products
            Stat::make('Total Available Products', Product::where('quantity', '>', 0)->count())
                ->label('Total Available Products')
                ->description('Count of products with stock available')
                ->color('success'),

            // Total Products Sold (This Month)
            Stat::make('Total Products Sold (This Month)', SoldProductHistory::whereMonth('sold_at', Carbon::now()->month)
                ->whereYear('sold_at', Carbon::now()->year)
                ->sum('quantity_sold'))
                ->label('Total Products Sold (This Month)')
                ->description('Count of products sold in this month')
                ->color('success'),

            // Total Products Bought (This Month)
            Stat::make('Total Products Bought (This Month)', StockPurchaseHistory::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->distinct('product_id')
                ->count('product_id'))
                ->label('Total Products Bought (This Month)')
                ->description('Count of products bought in this month')
                ->color('success'),
        ];
    }

    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'Products Sold',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'data' => [65, 59, 80, 81, 56, 55, 40], // Replace this with actual data logic as needed
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Define your chart type
    }
}
