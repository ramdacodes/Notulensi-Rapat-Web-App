<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Agenda;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class MostParticipantsAgendaTable extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Agenda::query()
                    ->selectRaw('agendas.*, JSON_LENGTH(participants) as participants_count')
                    ->orderByDesc('participants_count')
                    ->limit(5),
            )
            ->heading('Agenda with most participants')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('participants_count')
                    ->label('Total Participants'),
                TextColumn::make('status')
                    ->badge(),
            ])
            ->paginated(false)
            ->emptyStateHeading('Empty data')
            ->emptyStateDescription('No data found');
    }
}
