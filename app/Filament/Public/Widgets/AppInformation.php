<?php

namespace App\Filament\Public\Widgets;

use Filament\Widgets\Widget;

class AppInformation extends Widget
{
    protected static string $view = 'filament.public.widgets.app-information';

    protected int | string | array $columnSpan = 'full';
}
