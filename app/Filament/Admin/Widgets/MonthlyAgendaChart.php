<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Agenda;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class MonthlyAgendaChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly agendas';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $currentYear = Carbon::now()->year;

        $agendas = Agenda::whereYear('date', $currentYear)->get();

        $monthlyData = array_fill(0, 12, 0);

        foreach ($agendas as $agenda) {
            $month = Carbon::parse($agenda->date)->month;

            $monthlyData[$month - 1]++;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Agenda',
                    'data' => $monthlyData,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
