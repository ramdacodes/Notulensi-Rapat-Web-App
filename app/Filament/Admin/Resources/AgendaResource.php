<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AgendaResource\Pages;
use App\Models\Agenda;
use App\MeetingStatus;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class AgendaResource extends Resource
{
    protected static ?string $model = Agenda::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    protected static ?string $navigationLabel = 'Agenda';

    protected static ?string $slug = 'agenda';

    protected static ?string $breadcrumb = 'Agenda';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(2)
                ->schema([
                    Section::make('Agenda Details')
                        ->schema([
                            TextInput::make('name')
                                ->placeholder('Please enter agenda name')
                                ->autocomplete(false)
                                ->required(),
                            TextInput::make('location')
                                ->placeholder('Please enter location')
                                ->autocomplete(false)
                                ->required(),
                            DatePicker::make('date')
                                ->placeholder('Please select date')
                                ->native(false)
                                ->default(now())
                                ->required(),
                            TagsInput::make('participants')
                                ->placeholder('Please enter participants')
                                ->reorderable()
                                ->helperText('Please use enter to separate participants')
                                ->required(),
                            TextInput::make('inviter_name')
                                ->placeholder('Please enter inviter name')
                                ->autocomplete(false)
                                ->required(),
                            TextInput::make('inviter_position')
                                ->placeholder('Please enter inviter position')
                                ->autocomplete(false)
                                ->required(),
                            Select::make('status')
                                ->placeholder('Please select status')
                                ->options(MeetingStatus::class)
                                ->native(false)
                                ->required(),
                        ])
                        ->columnSpan(1),
                    Section::make('Rundown Details')
                        ->schema([
                            Repeater::make('rundowns')
                                ->required()
                                ->relationship('rundowns')
                                ->schema([
                                    TextInput::make('discussion')
                                        ->placeholder('Please enter discussion')
                                        ->required(),
                                    TimePicker::make('start_time')
                                        ->placeholder('Please enter start time')
                                        ->native(false)
                                        ->required(),
                                    TimePicker::make('end_time')
                                        ->placeholder('Please enter end time')
                                        ->native(false)
                                        ->required(),
                                    TagsInput::make('pics')
                                        ->placeholder('Please enter pics')
                                        ->helperText('Please use enter to separate pics')
                                        ->reorderable()
                                        ->required(),
                                ])
                                ->reorderable()
                                ->columnSpanFull()
                                ->default([]),
                        ])
                        ->columnSpan(1),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            ->filters([
                SelectFilter::make('status')
                    ->native(false)
                    ->options(MeetingStatus::class),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\Action::make('view_agenda_conclusion')
                        ->label('View Conclusion')
                        ->icon('heroicon-s-eye')
                        ->modalHeading(fn ($record) => 'Conclusion of ' . $record->name)
                        ->modalDescription(fn ($record) => 'Location: ' . $record->location . ', Date: ' . $record->date)
                        ->modalContent(fn ($record) => new HtmlString($record->notulensi?->conclusion ?? 'No conclusion available'))
                        ->modalFooterActions([
                            Action::make('close.modal')
                                ->label('Close')
                                ->visible(false),
                        ])
                        ->disabled(fn ($record) => empty($record->notulensi?->conclusion)),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('generate_agenda_pdf')
                        ->label('Generate PDF')
                        ->icon('heroicon-o-arrow-down-tray'),
                        // ->url(fn ($record) => route('generate.pdf', ['agenda' => $record->id]), true),
                    Tables\Actions\Action::make('copy_link_presence_agenda')
                        ->label('Copy Link Presence')
                        ->icon('heroicon-o-link')
                        ->action(function ($record, $livewire) {
                                // $livewire->dispatchBrowserEvent('copy-to-clipboard', ['text' => 'id']); // Kirim event ke browser
                                // $livewire->notify('success', 'Link copied to clipboard!');
                        })
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Success')
                                ->body('Agenda deleted successfully'),
                        )
                        ->failureNotification(
                            Notification::make()
                                ->danger()
                                ->title('Failed')
                                ->body('Failed to delete agenda'),
                        ),
                    Tables\Actions\DeleteAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Success')
                                ->body('Agenda deleted successfully'),
                        )
                        ->failureNotification(
                            Notification::make()
                                ->danger()
                                ->title('Failed')
                                ->body('Failed to delete agenda'),
                        ),
                ])
                ->tooltip('Actions'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->successNotification(
                            Notification::make()
                                ->success()
                                ->title('Success')
                                ->body('Agenda deleted successfully'),
                        )
                        ->failureNotification(
                            Notification::make()
                                ->danger()
                                ->title('Failed')
                                ->body('Failed to delete agenda'),
                        ),
                ]),
            ])
            ->emptyStateHeading('Empty data')
            ->emptyStateDescription('No data found');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgendas::route('/'),
            'create' => Pages\CreateAgenda::route('/create'),
            'edit' => Pages\EditAgenda::route('/{record}/edit'),
        ];
    }
}
