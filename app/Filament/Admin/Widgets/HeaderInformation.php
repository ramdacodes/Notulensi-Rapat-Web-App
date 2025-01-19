<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\Widget;

class HeaderInformation extends Widget
{
    protected static string $view = 'filament.admin.widgets.header-information';

    protected int | string | array $columnSpan = 'full';
}
