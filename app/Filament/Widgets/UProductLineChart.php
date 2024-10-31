<?php

namespace App\Filament\Widgets;

use App\Models\StockPurchaseHistory;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class UProductLineChart extends ChartWidget
{
    protected function getData(): array
    {
        // Get monthly expenses totals for the current year
        $monthlyExpensesData = StockPurchaseHistory::selectRaw('MONTH(created_at) as month, SUM(quantity * supplier_price) as total_expense')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_expense', 'month')
            ->toArray();

        // Prepare data for each month, filling missing months with 0
        $expenseData = [];
        for ($month = 1; $month <= 12; $month++) {
            $expenseData[] = $monthlyExpensesData[$month] ?? 0;
        }

        return [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            'datasets' => [
                [
                    'label' => 'Total Product Expenses',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'data' => $expenseData,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
