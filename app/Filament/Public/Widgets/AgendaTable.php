<?php

namespace App\Filament\Public\Widgets;

use App\MeetingStatus;
use App\Models\Agenda;
use Carbon\Carbon;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\HtmlString;

class AgendaTable extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Agenda::query()
            )
            ->heading(null)
            ->filters([
                SelectFilter::make('status')
                    ->native(false)
                    ->options(MeetingStatus::class),
            ])
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('inviter_name')
                    ->searchable(),
                TextColumn::make('location')
                    ->searchable(),
                TextColumn::make('date')
                    ->date(),
                TextColumn::make('participants')
                    ->searchable()
                    ->badge(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->getStateUsing(function ($record) {
                        return Carbon::parse($record->created_at)->timezone('Asia/Jakarta')->format('M d, Y H:i:s');
                    }),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('view_agenda_conclusion')
                        ->label('View Conclusion')
                        ->icon('heroicon-s-eye')
                        ->modalHeading(fn ($record) => 'Conclusion of '.$record->name)
                        ->modalDescription(fn ($record) => 'Location: '.$record->location.', Date: '.$record->date)
                        ->modalContent(fn ($record) => new HtmlString($record->notulensi?->conclusion ?? 'No conclusion available'))
                        ->modalFooterActions([
                            Action::make('close.modal')
                                ->label('Close')
                                ->visible(false),
                        ])
                        ->disabled(fn ($record) => empty($record->notulensi?->conclusion)),
                    Tables\Actions\Action::make('view_documentation')
                        ->label('View Documentation')
                        ->icon('heroicon-s-photo')
                        ->modalHeading(fn ($record) => 'Documentation of '.$record->name)
                        ->modalDescription(fn ($record) => 'Location: '.$record->location.', Date: '.$record->date)
                        ->modalContent(fn ($record) => view('filament.agenda.documentation', ['notulensi' => $record->notulensi]))
                        ->modalFooterActions([
                            Action::make('close.modal')
                                ->label('Close')
                                ->visible(false),
                        ])
                        ->disabled(fn ($record) => empty($record->notulensi?->conclusion)),
                ]),
            ])
            ->emptyStateHeading('Empty data')
            ->emptyStateDescription('No data found');
    }
}
