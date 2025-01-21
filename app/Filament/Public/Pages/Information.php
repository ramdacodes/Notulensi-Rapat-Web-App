<?php

namespace App\Filament\Public\Pages;

use App\Filament\Public\Widgets\AgendaTable;
use App\Filament\Public\Widgets\AppInformation;
use App\Filament\Public\Widgets\StatsOverview;
use Filament\Actions\Action;
use Filament\Pages\Page;

class Information extends Page
{
    protected static string $view = 'filament.public.pages.information';

    protected static ?string $title = 'Public Information of Minutes of Meeting';

    protected function getActions(): array
    {
        return [
            Action::make('Login as Admin')
                ->icon('heroicon-s-lock-closed')
                ->url('/admin/login'),
            Action::make('Login as Notulis')
                ->icon('heroicon-s-lock-closed')
                ->url('/notulis/login'),
            Action::make('Presence')
                ->icon('heroicon-o-presentation-chart-line')
                ->url('/presence'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            AppInformation::class,
            StatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            AgendaTable::class,
        ];
    }
}
