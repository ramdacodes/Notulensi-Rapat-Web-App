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
        $userQuery = User::query();

        $totalAdmin = $userQuery->clone()->where('role', 'admin')->count();
        $totalNotulen = $userQuery->clone()->where('role', 'notulis')->count();

        return [
            Stat::make('Agenda', $totalAgenda)
                ->description('Total agenda'),
            Stat::make('Admin', $totalAdmin)
                ->description('Total admin'),
            Stat::make('Total Notulis', $totalNotulen)
                ->description('Total notulis'),
        ];
    }
}
