<?php

namespace App\Filament\Widgets;

use App\Models\SoldProductHistory;
use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class TProductLineChart extends ChartWidget
{
    protected function getData(): array
    {
        // Get monthly sales totals for the current year
        $monthlySalesData = SoldProductHistory::selectRaw('MONTH(sold_at) as month, SUM(sale_price * quantity_sold) as total_sales')
            ->whereYear('sold_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total_sales', 'month')
            ->toArray();

        // Prepare data for each month, filling missing months with 0
        $salesData = [];
        for ($month = 1; $month <= 12; $month++) {
            $salesData[] = $monthlySalesData[$month] ?? 0;
        }

        return [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            'datasets' => [
                [
                    'label' => 'Total Sales',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                    'borderColor' => 'rgba(75, 192, 192, 1)',
                    'data' => $salesData,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
