<?php

namespace App\Filament\Widgets;

use App\Models\SoldProductHistory;
use App\Models\StockPurchaseHistory;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class SalesOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Total Sales made this month
            Stat::make('Total Sales made this month', SoldProductHistory::whereMonth('sold_at', Carbon::now()->month)
                ->whereYear('sold_at', Carbon::now()->year)
                ->sum('sale_price'))
                ->label('Total Sales (This Month)')
                ->description('Total sales made this month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart($this->getMonthlySalesChartData()),

            // Total Sales made this Year
            Stat::make('Total Sales made this Year', SoldProductHistory::whereYear('sold_at', Carbon::now()->year)
                ->sum('sale_price'))
                ->label('Total Sales (This Year)')
                ->description('Total sales made this Year')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart($this->getYearlySalesChartData()),

            // Total Expense this Month
            Stat::make('Total Expense this Month', StockPurchaseHistory::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->selectRaw('SUM(quantity * supplier_price) as total_expense')->first()->total_expense ?? 0)
                ->label('Total Expense (This Month)')
                ->description('Total Expense this month')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart($this->getMonthlyExpenseChartData()),

            // Total Expense this Year
            Stat::make('Total Expense this Year', StockPurchaseHistory::whereYear('created_at', Carbon::now()->year)
                ->selectRaw('SUM(quantity * supplier_price) as total_expense')->first()->total_expense ?? 0)
                ->label('Total Expense (This Year)')
                ->description('Total Expense this Year')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart($this->getYearlyExpenseChartData()),
        ];
    }

    // Function to get monthly sales chart data
    protected function getMonthlySalesChartData(): array
    {
        return SoldProductHistory::selectRaw('SUM(sale_price) as total')
            ->whereYear('sold_at', Carbon::now()->year)
            ->groupByRaw('MONTH(sold_at)')
            ->pluck('total')
            ->toArray();
    }

    // Function to get yearly sales chart data
    protected function getYearlySalesChartData(): array
    {
        return SoldProductHistory::selectRaw('SUM(sale_price) as total')
            ->groupByRaw('YEAR(sold_at)')
            ->pluck('total')
            ->toArray();
    }

    // Function to get monthly expense chart data
    protected function getMonthlyExpenseChartData(): array
    {
        return StockPurchaseHistory::selectRaw('SUM(quantity * supplier_price) as total_expense')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupByRaw('MONTH(created_at)')
            ->pluck('total_expense')
            ->toArray();
    }

    // Function to get yearly expense chart data
    protected function getYearlyExpenseChartData(): array
    {
        return StockPurchaseHistory::selectRaw('SUM(quantity * supplier_price) as total_expense')
            ->groupByRaw('YEAR(created_at)')
            ->pluck('total_expense')
            ->toArray();
    }
}
