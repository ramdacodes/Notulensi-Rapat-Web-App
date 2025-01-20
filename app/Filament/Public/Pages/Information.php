<?php

namespace App\Filament\Public\Pages;

use App\Filament\Public\Widgets\AgendaTable;
use App\Filament\Public\Widgets\AppInformation;
use App\Filament\Public\Widgets\StatsOverview;
use Filament\Pages\Page;

class Information extends Page
{
    protected static string $view = 'filament.public.pages.information';

    protected static ?string $title = 'Public Information of Minutes of Meeting';

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
