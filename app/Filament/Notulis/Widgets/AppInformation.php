<?php

namespace App\Filament\Notulis\Widgets;

use Filament\Widgets\Widget;

class AppInformation extends Widget
{
    protected static string $view = 'filament.notulis.widgets.app-information';

    protected int | string | array $columnSpan = 'full';
}
