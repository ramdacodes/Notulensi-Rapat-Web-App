<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Agenda;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAgendaTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Agenda::query()
                    ->limit(5),
            )
            ->heading('Latest agendas')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('location'),
                TextColumn::make('date')
                    ->date(),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->paginated(false)
            ->emptyStateHeading('Empty data')
            ->emptyStateDescription('No data found');
    }
}
