<?php

namespace App\Filament\Widgets;

use App\Models\Expense;
use Filament\Widgets\ChartWidget;

class ExpensesPerMonthChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {

        $expensesByMonth = Expense::sumByMonth()->get();

        $labels = []; // To store month labels
        $data = [];   // To store expense data

        foreach ($expensesByMonth as $expense) {
            // Extract month and total expense from the query result
            $month = date('M Y', strtotime($expense->month));
            $total = $expense->total;

            $labels[] = $month; // Add the month label
            $data[] = $total;   // Add the total expense data
        }

        $chartData = [
            'datasets' => [
                [
                    'label' => 'Expenses',
                    'data' => $data,
                    'fill' => 'start',
                ],
            ],
            'labels' => $labels,
        ];


        return $chartData;
    }

    protected function getType(): string
    {
        return 'line';
    }
}
