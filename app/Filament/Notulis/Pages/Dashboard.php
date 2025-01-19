<?php

namespace App\Filament\Notulis\Pages;

use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = 'filament.notulis.pages.dashboard';

    protected static ?string $title = 'Dashboard Notulis';

    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $navigationGroup = 'Home';
}
