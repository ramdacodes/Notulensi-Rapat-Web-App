<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;

class AppInformation extends Widget
{
    protected static string $view = 'filament.admin.widgets.app-information';

    protected int | string | array $columnSpan = 'full';
}
