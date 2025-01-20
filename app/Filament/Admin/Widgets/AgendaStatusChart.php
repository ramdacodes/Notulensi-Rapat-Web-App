<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Agenda;
use Carbon\Carbon;

class AgendaStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Agenda by status';

    public ?string $filter = 'year';

    protected function getFilters(): ?array
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }

    protected function getData(): array
    {
        $filter = $this->filter;
        $query = Agenda::query();

        switch ($filter) {
            case 'today':
                $query->whereDate('date', Carbon::today());
                break;
            case 'week':
                $query->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                break;
            case 'month':
                $query->whereMonth('date', Carbon::now()->month)
                      ->whereYear('date', Carbon::now()->year);
                break;
            case 'year':
                $query->whereYear('date', Carbon::now()->year);
                break;
        }

        $notStarted = $query->clone()->where('status', 'not_started')->count();
        $ongoing = $query->clone()->where('status', 'ongoing')->count();
        $finished = $query->clone()->where('status', 'finished')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Agenda',
                    'data' => [$notStarted, $ongoing, $finished],
                    'backgroundColor' => [
                        'rgb(128, 128, 128)',
                        'rgb(54, 162, 235)',
                        'rgb(75, 192, 192)',
                    ],
                    'hoverOffset' => 4,
                ],
            ],
            'labels' => ['Not Started', 'Ongoing', 'Finished'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => true,
            'aspectRatio' => 2,
            'scales' => [
                'x' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'display' => false,
                    ],
                ],
                'y' => [
                    'grid' => [
                        'display' => false,
                    ],
                    'ticks' => [
                        'display' => false,
                    ],
                ],
            ],
            'elements' => [
                'arc' => [
                    'borderWidth' => 0,
                ],
            ],
        ];
    }
}
