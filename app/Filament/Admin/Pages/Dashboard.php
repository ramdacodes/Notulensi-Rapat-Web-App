<?php

namespace App\Filament\Admin\Pages;

use App\Filament\Admin\Widgets\AgendaStatusChart;
use App\Filament\Admin\Widgets\AppInformation;
use App\Filament\Admin\Widgets\DashboardStatsOverview;
use App\Filament\Admin\Widgets\LatestAgendaTable;
use App\Filament\Admin\Widgets\MonthlyAgendaChart;
use App\Filament\Admin\Widgets\MostParticipantsAgendaTable;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.admin.pages.dashboard';

    protected static ?string $title = 'Dashboard Admin';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $navigationGroup = 'Home';

    protected function getHeaderWidgets(): array
    {
        return [
            AppInformation::class,
            DashboardStatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            MostParticipantsAgendaTable::class,
            LatestAgendaTable::class,
            MonthlyAgendaChart::class,
            AgendaStatusChart::class,
        ];
    }
}
