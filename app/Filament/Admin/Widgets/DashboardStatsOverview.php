<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Agenda;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Summary';

    protected ?string $description = 'Overview of some stats.';

    protected function getStats(): array
    {
        $totalAgenda = Agenda::count();
        $totalAdmin = User::where('role', 'admin')->count();
        $totalNotulen = User::where('role', 'notulen')->count();

        return [
            Stat::make('Total Agenda', $totalAgenda),
            Stat::make('Total Admin', $totalAdmin),
            Stat::make('Total Notulis', $totalNotulen),
        ];
    }
}
