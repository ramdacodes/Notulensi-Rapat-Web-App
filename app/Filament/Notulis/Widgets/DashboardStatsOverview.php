<?php

namespace App\Filament\Notulis\Widgets;

use App\Models\Agenda;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Summary';

    protected ?string $description = 'Overview of some stats.';

    protected function getStats(): array
    {
        $agendaQuery = Agenda::query();

        $totalAgendaNotStarted = $agendaQuery->clone()->where('status', 'not_started')->count();
        $totalAgendaOngoing = $agendaQuery->clone()->where('status', 'ongoing')->count();
        $totalAgendaFinished = $agendaQuery->clone()->where('status', 'finished')->count();

        return [
            Stat::make('Agenda Not Started', $totalAgendaNotStarted)
                ->description('Total agenda not yet started'),
            Stat::make('Agenda Ongoing', $totalAgendaOngoing)
                ->description('Total agenda currently ongoing'),
            Stat::make('Agenda Finished', $totalAgendaFinished)
                ->description('Total agenda completed'),
        ];
    }
}
